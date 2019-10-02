<template>
  <div class="app-container">
    <div>
      <el-row :gutter="24">
        <!-- <el-col :span="6" :xs="24">
          <user-card v-if="user" :user="user" />
        </el-col> -->

        <el-col :span="24" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>NHÀ TRỌ</span>
            </div>
            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button @click="dialogFormNewPost = true" style="border-color: #b3d8ff !important;" plain round class="filter-item" type="default" icon="el-icon-plus" size="mini">
                Thêm mới
              </el-button>

              <!-- Xóa nhiều -->
              <el-button
              class="filter-item"
              @click="handleRemove(null, 'multiple-delete')"
              style="border-color: #fbc4c4 !important; box-shadow: 0px 1px 5px 0px rgb(251, 196, 196) !important;"
              type="default" icon="el-icon-delete"
              size="mini"
              plain round>
                Xóa nhiều
              </el-button>
            </div>

            <el-table
              :data="tableData"
              border fit style="width: 100%"
              @selection-change="handleSelectionChange">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row._changing" class="el-icon-loading" />
                  <div v-else>
                    <el-dropdown trigger="click" @command="handleChangeActions">
                      <el-button type="info" size="small" plain>
                        <i class="el-icon-setting" />
                      </el-button>
                      <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item :command="{ type: 'edit', data: scope.row }">Sửa</el-dropdown-item>
                        <!-- <el-dropdown-item :command="{ type: 'newpost' }">Đăng bài</el-dropdown-item> -->
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>

              <el-table-column type="selection" width="45"/>

              <el-table-column property="name" label="Tên" width="203">
                <template slot-scope="scope">{{ scope.row.name }}</template>
              </el-table-column>

              <el-table-column property="address" label="Địa chỉ">
                <template slot-scope="scope">{{ scope.row.address }}</template>
              </el-table-column>

              <el-table-column property="created_at" label="Ngày tạo" width="203" show-overflow-tooltip>
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.created_at">{{ new Date(scope.row.created_at) | convertToDate }}</span>
                </template>
              </el-table-column>

              <el-table-column width="55">
                <el-button type="info" size="small" circle>
                  <i class="el-icon-upload2" />
                </el-button>
              </el-table-column>

              <el-table-column width="55">
                <template slot-scope="scope">
                  <el-button type="danger" size="small" @click="handleRemove(scope.row)" circle>
                    <i class="el-icon-delete" />
                  </el-button>
                </template>
              </el-table-column>
            </el-table>

            <el-dialog title="NHÀ TRỌ - XÓA" :visible.sync="dialogConfirmRemove">
              <el-alert
                title="Xác nhận xóa"
                type="error" 
                show-icon>
                <template slot>
                  <span v-if="toRemove.length === 1">Bạn có muốn xóa nhà trọ: <strong>{{toRemove[0].name}}</strong> không?</span>
                  <div v-else-if="toRemove.length > 1">
                    <p>Bạn có muốn xóa những nhà trọ sau không?</p>
                    <ul>
                      <li v-for="item in toRemove" :key="'remove-' + item.id">{{ item.name }}</li>
                    </ul>
                  </div>
                </template>
              </el-alert>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" @click="isRemoveMultiple = dialogConfirmRemove = false" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button v-if="!isRemoveMultiple" type="primary" @click="removeMotel(toRemove[0].id)" icon="el-icon-check" plain>Đồng ý</el-button>
                <el-button v-else type="primary" @click="multipleRemovalMotel" icon="el-icon-check" plain>Đồng ý</el-button>
              </span>
            </el-dialog>

            <el-dialog title="NHÀ TRỌ - CHỈNH SỬA" :visible.sync="dialogFormVisible">
              <el-form ref="form" :model="formEdit" label-width="120px">
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item label="Tên">
                      <el-input
                        v-if="formEdit"
                        v-model="formEdit.name"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item label="Địa chỉ">
                      <el-input
                        v-if="formEdit"
                        v-model="formEdit.address"
                        :disabled="true"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item label="Mô tả">
                      <el-input v-if="formEdit"
                        v-model="formEdit.description"
                        type="textarea"
                        :rows="2"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" @click="dialogFormVisible = false" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button type="primary" @click="editMotel" icon="el-icon-check" plain>Đồng ý</el-button>
              </span>
            </el-dialog>

            <el-dialog title="NHÀ TRỌ - TẠO MỚI" :visible.sync="dialogFormNewPost">
              <el-form ref="form" :model="formCreate" label-width="150px">
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item label="Tên">
                      <el-input
                        v-model="formCreate.name"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item label="Địa chỉ">
                      <el-input
                        v-model="formCreate.address"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item label="Mô tả">
                      <el-input
                        v-model="formCreate.description"
                        type="textarea"
                        :rows="2"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                </el-row>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" @click="dialogFormNewPost = false" plain>Hủy bỏ</el-button>
                <el-button type="primary" icon="el-icon-check" @click="createMotel" plain>Tạo mới</el-button>
              </span>
            </el-dialog>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import { fetchList, create, edit, remove } from '@/api/motel'
import UserCard from '@/views/profile/components/UserCard'

export default {
  name: 'Nhatro',
  components: {
    UserCard
  },
  data() {
    return {
      dialogFormVisible: false,
      dialogFormNewPost: false,
      dialogConfirmRemove: false,
      toRemove: [{ id: 0, name: null }],
      formEdit: null, // { address,  description, id, name }
      formCreate: { name: '', address: '', description: ''},
      tableData: [],
      multipleSelection: [],
      isRemoveMultiple: false
    }
  },
  computed: {
    ...mapGetters([
      'avatar'
    ])
  },
  mounted () {
    this.getApi()
    },
  watch: {
    '$route': {
      handler: function(nextValue) {
        const { path } = nextValue
        if (path === "/nha-tro/index") {
          this.getApi();
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    async getApi() {
      const data = await fetchList().then(res => {        
        console.log('get api', res)
        if (res && res.success) {
          this.tableData = (res.data && res.data.data) || []
        }
      })
    },
    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    createDataForm(obj) {
      if (null == obj || "object" != typeof obj) return obj
      const copy = obj.constructor()
      for (const attr in obj) {
        if (obj.hasOwnProperty(attr) && obj[attr]) copy[attr] = obj[attr]
      }
      return copy
    },
    updateTableData(row) {
      this.tableData = this.tableData.map(item => {
        if (item.id === row.id) return row
        return item
      })
    },
    editMotel() {
      console.log('sửa nhà trọ')
      const editForm = this.createDataForm(this.formEdit)
      edit(editForm).then(res => {
        console.log(res, this.tableData)
        this.dialogFormVisible = false
        if (res.success) {
          this.updateTableData(res.data)
        }
      })
    },
    createMotel() {
      console.log('tạo nhà trọ')
      create(this.formCreate).then(res => {
        console.log(res)
        this.dialogFormNewPost = false
        if (res.success) {
          this.tableData.unshift(res.data)
        }
      })
    },
    handleRemove(row, action) {
      if (action && action === 'multiple-delete') {
        if (this.multipleSelection.length > 1)  {
          this.dialogConfirmRemove = true
          this.toRemove = this.multipleSelection
          this.isRemoveMultiple = true
        } else {
          this.$notify.error({
            title: 'Lỗi',
            message: 'Bạn chưa chọn mục xóa!'
          })
          return false
        }
      } else {
        console.log(row)
        this.dialogConfirmRemove = true
        this.toRemove = [row]
      }
    },
    removeMotel(id) {
      if (!id) return
      remove(id).then(res => {
        console.log(res)
        this.dialogConfirmRemove = false
        if (res.success) {
          this.tableData = this.tableData.filter(item => (item.id !== id))
        }
      })
      
      this.toRemove = []
    },
    multipleRemovalMotel() {
      console.log('multipleRemovalMotel')
      this.toRemove.forEach(element => {
        this.removeMotel(element.id)
      })
      this.isRemoveMultiple = false
      this.multipleSelection = []
      this.toRemove = []
    },
    onSubmit() {},
    handleChangeActions(items) {
      const { type, data } = items
      console.log(items)
      switch (type) {
        case 'edit':
          this.formEdit = data
          this.dialogFormVisible = true
          break
        case 'create':
          this.formCreate = {
            name: '',
            address: '',
            description: ''
          }
          this.dialogFormNewPost = true
          break
        default:
          break
      }
    }
  }
}
</script>

<style lang="scss" scoped>

.filter-container {
  display: flex;
  justify-content: flex-end;
}

.el-button--mini.is-round:hover {
  box-shadow: 0px 1px 5px 0px rgb(179, 216, 255) !important;
}

input[type=text] {
  border: none;
  border-bottom: 1px solid #dcdfe6;
  outline: none;
}
</style>
