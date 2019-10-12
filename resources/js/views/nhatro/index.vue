<template>
  <div class="app-container">
    <Loading v-if="initing"/>

    <div class="content" v-else>
      <el-row :gutter="24">

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
              type="danger" icon="el-icon-delete"
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

              <el-table-column property="name" label="Tên">
                <template slot-scope="scope">{{ scope.row.name }}</template>
              </el-table-column>

              <el-table-column property="address" label="Địa chỉ">
                <template slot-scope="scope">{{ scope.row.address }}</template>
              </el-table-column>

              <el-table-column property="description" label="Mô tả">
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.description">{{ scope.row.description }}</span>
                </template>
              </el-table-column>

              <el-table-column property="created_at" label="Ngày tạo" width="203">
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.created_at">{{ new Date(scope.row.created_at) | convertToDate }}</span>
                </template>
              </el-table-column>

              <el-table-column width="55">
                <template slot-scope="scope">
                  <el-button type="info" size="small" @click="handleChangeActions({type: 'edit', data: scope.row})" circle>
                    <i class="el-icon-upload2" />
                  </el-button>
                </template>
              </el-table-column>

              <el-table-column width="55">
                <template slot-scope="scope">
                  <el-button type="danger" size="small" @click="handleRemove(scope.row)" circle>
                    <i class="el-icon-delete" />
                  </el-button>
                </template>
              </el-table-column>
            </el-table>

            <div class="pagination-container" v-if="pagination.total">
              <el-pagination
                @current-change="handleCurrentChange"
                background
                :current-page.sync="pagination.current_page"
                layout="prev, pager, next"
                :page-size="pagination.per_page"
                :total="pagination.total"
                :disabled="initing">
              </el-pagination>
            </div>

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
                    <el-form-item
                      label="Tên"
                      prop="name"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập tên nhà trọ !', trigger: 'blur' }
                      ]">
                      <el-input
                        v-if="formEdit"
                        v-model="formEdit.name"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Địa chỉ"
                      prop="address"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập địa chỉ nhà trọ !', trigger: 'blur' }
                      ]">
                      <el-input
                        v-if="formEdit"
                        v-model="formEdit.address"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item
                      label="Mô tả"
                      prop="description"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập mô tả nhà trọ !', trigger: 'blur' }
                      ]">
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
                    <el-form-item
                      label="Tên"
                      prop="name"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập tên nhà trọ !', trigger: 'blur' }
                      ]">
                      <el-input
                        v-model="formCreate.name"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Địa chỉ"
                      prop="address"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập tên địa chỉ nhà trọ !', trigger: 'blur' }
                      ]">
                      <el-input
                        v-model="formCreate.address"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Mô tả"
                      prop="description"
                      :rules="[
                        { required: true, message: 'Vui lòng nhập mô tả nhà trọ !', trigger: 'blur' }
                      ]">
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
                <el-button type="primary" icon="el-icon-refresh" @click="resetForm('form')" plain>Đặt lại</el-button>
                <el-button type="success" icon="el-icon-check" @click="createMotel" plain>Tạo mới</el-button>
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
import {  create, edit, remove } from '@/api/motel'
import Loading from '@/components/Loading'

const defaultCreate = { name: '', address: '', description: '' }

export default {
  name: 'Nhatro',
  components: {
    Loading
  },
  data() {
    return {
      initing: false,
      dialogFormVisible: false,
      dialogFormNewPost: false,
      dialogConfirmRemove: false,
      toRemove: [{ id: 0, name: null }],
      formEdit: null, // { address,  description, id, name }
      formCreate: JSON.parse(JSON.stringify(defaultCreate)),
      tableData: [],
      multipleSelection: [],
      pagination: {
        current_page: 1,
        per_page: 0,
        total: 0
      },
      isRemoveMultiple: false
    }
  },
  computed: {
    ...mapGetters([
      'avatar',
      'motels'
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
          this.getApi()
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    handleCurrentChange(val) {
      this.pagination.current_page = val
      this.getApi(val)
    },
    async getApi(current_page) {
      this.initing = true
      const data = await this.$store.dispatch('motel/FetchList', current_page).then(res => {
        this.tableData = res.data && res.data.data
        this.initing = false
        const api_current_page = res.data.current_page
        const total = res.data.total
        const per_page = res.data.per_page
        this.updatePagination(api_current_page, total, per_page);
      })
      return data
    },
    updatePagination (
      current_page = this.pagination.current_page,
      total = this.pagination.total,
      per_page = this.pagination.per_page) {
      const updatedPagination = {
        current_page
      }
      total && (updatedPagination.total = total)
      per_page && (updatedPagination.per_page = per_page)
      this.pagination = JSON.parse(JSON.stringify(updatedPagination))
    },
    handleSelectionChange(val) {
      this.multipleSelection = val
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
      this.$refs['form'].validate(valid => {
        if (valid) {
          const editForm = this.createDataForm(this.formEdit)
          edit(editForm).then(res => {
            this.dialogFormVisible = false
            if (res.success) {
              this.updateTableData(res.data)
            }
            this.$notify.success({
              title: 'Thành công',
              message: 'Dữ liệu được sửa thành công !',
              duration: 4000
            })
          })
          .catch(_err => {
            console.log(_err)
            this.$notify.error({
              title: 'Lỗi',
              message: 'Đang gặp sự cố, vui lòng báo hệ thống xử lý!',
              duration: 4000
            })
          })
        } else {
          return false
        }
      })
    },
    createMotel() {
      this.$refs['form'].validate(valid => {
        if (valid) {
          create(this.formCreate).then(res => {
            this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
            this.dialogFormNewPost = false
            if (res.success) {
              this.tableData.unshift(res.data)
            }
            this.$notify.success({
              title: 'Thành công',
              message: 'Dữ liệu tạo mới thành công !',
              duration: 4000
            })
          })
          .catch(_err => {
            console.log(_err)
            this.initing = false
            this.$notify.error({
              title: 'Lỗi',
              message: 'Đang gặp sự cố, vui lòng báo hệ thống xử lý!',
              duration: 4000
            })
          })
        } else {
          return false
        }
      })
    },
    handleRemove(row, action) {
      if (action && action === 'multiple-delete') {
        if (this.multipleSelection.length > 0)  {
          this.dialogConfirmRemove = true
          this.toRemove = this.multipleSelection
          this.isRemoveMultiple = true
        } else {
          this.$notify.error({
            title: 'Lỗi',
            message: 'Bạn chưa chọn mục xóa!',
            duration: 4000
          })
          return false
        }
      } else {
        this.dialogConfirmRemove = true
        this.toRemove = [row]
      }
    },
    removeMotel(id) {
      if (!id) return
      remove(id).then(res => {
        this.dialogConfirmRemove = false
        if (res.success) {
          this.tableData = this.tableData.filter(item => (item.id !== id))
        }
        this.$notify.success({
          title: 'Thành công',
          message: 'Mục bạn chọn đã được xóa !',
          duration: 4000
        })
      })
      .catch(_err => {
        console.log(_err)
        this.initing = false
        this.$notify.error({
          title: 'Lỗi',
          message: 'Đang gặp sự cố, vui lòng báo hệ thống xử lý!',
          duration: 4000
        })
      })
      this.toRemove = []
    },
    multipleRemovalMotel() {
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
    },
    resetForm(form) {
      this.$refs[form].resetFields()
    }
  }
}
</script>

<style lang="scss" scoped>
.pagination-container {
  display: flex;
  justify-content: flex-end;
}

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
