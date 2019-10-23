<template>
  <div class="app-container">
    <Loading v-if="initing"/>

    <div class="content" v-else>
      <el-row :gutter="24">
        <el-col :span="24" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>PHÒNG TRỌ</span>
            </div>

            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button class="bordered filter-item" plain round type="default" icon="el-icon-plus" size="mini"
              @click="dialogFormNewPost = true">
                Thêm mới
              </el-button>

              <!-- Xuất hóa đơn -->
              <el-button class="bordered filter-item" type="default" icon="el-icon-printer" size="mini" plain round>
                Xuất hóa đơn
              </el-button>

              <!-- Thêm nhiều -->
              <el-button class="bordered filter-item" type="default" icon="el-icon-check" size="mini" plain round>
                Thêm nhiều
              </el-button>

              <!-- Nhập excel -->
              <el-button class="bordered filter-item" type="default" icon="el-icon-upload2" size="mini" plain round>
                Nhập excel
              </el-button>

              <!-- Xuất excel -->
              <el-button style="margin-right: 10px;" class="bordered filter-item" type="default" icon="el-icon-download" size="mini" plain round>
                Xuất excel
              </el-button>

              <el-row>
                <div :class="{'show': showInputSearch}" class="header-search">
                  <el-select
                    ref="headerSearchSelect"
                    v-model="search"
                    filterable
                    default-first-option
                    remote
                    placeholder="Tìm kiếm phòng"
                    class="header-search-select"
                    @change="changeShowInputSearch"
                  >
                    <el-option v-for="item in options" :key="item.path" :value="item" :label="item.title.join(' > ')" />
                  </el-select>
                </div>
              </el-row>

              <!-- Tìm kiếm -->
              <el-button @click.stop="clickShowInputSearch" class="bordered filter-item" type="default" icon="el-icon-search" size="mini" plain round>
                Tìm kiếm
              </el-button>

              <!-- Xóa nhiều -->
              <el-button @click="handleRemove(null, 'multiple-delete')" class="bordered filter-item" type="danger" icon="el-icon-delete" size="mini" plain round>
                Xóa nhiều
              </el-button>
            </div>

            <el-table
              :data="tableData"
              border fit style="width: 100%"
              @selection-change="handleSelectionChange">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row.changing" class="el-icon-loading" />
                  <el-dropdown trigger="click" @command="handleChangeActions">
                    <el-button type="info" size="small" plain>
                      <i class="el-icon-setting" />
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item :command="{ type: 'edit', data: scope.row }">Sửa</el-dropdown-item>
                      <el-dropdown-item>Trạng thái</el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </template>
              </el-table-column>

              <el-table-column type="selection"></el-table-column>

              <el-table-column property="floor" label="Tầng">
                <template slot-scope="scope">
                  <span>{{ scope.row.floor }}</span>
                </template>
              </el-table-column>

              <el-table-column property="name" label="Tên phòng">
                <template slot-scope="scope">
                  <span>{{ scope.row.name }}</span>
                </template>
              </el-table-column>

              <el-table-column property="motel_id" label="ID phòng">
                <template slot-scope="scope">
                  <span>{{ scope.row.motel_id }}</span>
                </template>
              </el-table-column>

              <el-table-column property="price" label="Đơn giá">
                <template slot-scope="scope">
                  <span>{{ scope.row.price | formatMoney }}</span>
                </template>
              </el-table-column>

              <el-table-column property="created_at" label="Ngày tạo">
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.created_at">{{ new Date(scope.row.created_at) | convertToDate }}</span>
                </template>
              </el-table-column>

              <el-table-column property="status" label="Trạng thái">
                <template slot-scope="scope">
                  <el-tag type="info" effect="dark" v-if="scope.row.status === 1">Ngừng hoạt động</el-tag>
                  <el-tag type="warning" effect="dark" v-else-if="scope.row.status === 2">Đang bảo trì</el-tag>
                  <el-tag type="success" effect="dark" v-else-if="scope.row.status === 3">Đang hoạt động</el-tag>
                </template>
              </el-table-column>

              <el-table-column property="description" label="Mô tả">
                <template slot-scope="scope">
                  <span>{{ scope.row.description }}</span>
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

            <el-dialog :close-on-click-modal="false" :close-on-press-escape="false" title="PHÒNG TRỌ - XÓA" :visible.sync="dialogConfirmRemove">
              <el-alert
                title="Xác nhận xóa"
                type="error" 
                show-icon
                :closable="false">
                <template slot>
                  <span v-if="toRemove.length === 1">Bạn có muốn xóa phòng trọ: <strong>{{toRemove[0].name}}</strong> không?</span>
                  <div v-else-if="toRemove.length > 1">
                    <p>Bạn có muốn xóa những phòng trọ sau không?</p>
                    <ul>
                      <li v-for="item in toRemove" :key="'remove-' + item.id">{{ item.name }}</li>
                    </ul>
                  </div>
                </template>
              </el-alert>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" @click="isRemoveMultiple = dialogConfirmRemove = false" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button v-if="!isRemoveMultiple" type="primary" @click="removeRent(toRemove[0].id)" icon="el-icon-check" plain>Đồng ý</el-button>
                <el-button v-else type="primary" @click="multipleRemovalRent" icon="el-icon-check" plain>Đồng ý</el-button>
              </span>
            </el-dialog>

            <el-dialog :close-on-click-modal="false" :close-on-press-escape="false" title="PHÒNG TRỌ - TẠO MỚI" :visible.sync="dialogFormNewPost">
              <el-form ref="dataForm" :model="createForm" label-position="left" label-width="150px">
                <el-form-item
                  label="Tên"
                  prop="name"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập tên phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-model="createForm.name" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="Tầng"
                  prop="floor"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập tầng của phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-model="createForm.floor" :disabled="false"/>
                </el-form-item>

                <el-form-item
                  label="Số lượng tối đa"
                  prop="max"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập số lượng người tối đa trong phòng !', trigger: 'blur' }
                  ]">
                  <el-input v-model="createForm.max" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="ID phòng"
                  prop="motel_id"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập id phòng !', trigger: 'blur' }
                  ]">
                  <el-input v-model="createForm.motel_id" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="Trạng thái"
                  prop="status"
                  :rules="[
                    { required: true, message: 'Vui lòng chọn trạng thái phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-select v-model="createForm.status">
                    <el-option
                      v-for="item in optionStatus"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                    </el-option>
                  </el-select>
                </el-form-item>

                <el-form-item
                  label="Thành tiền"
                  prop="price"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập số tiền tương ứng !', trigger: 'blur' }
                  ]">
                  <el-input @keyup.native="handleAmountInput" v-model="createForm.price" :disabled="false" :maxlength="15"></el-input>
                </el-form-item>

                <el-form-item
                  label="Mô tả"
                  prop="description"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập mô tả phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-model="createForm.description" :autosize="{ minRows: 2, maxRows: 4}" type="textarea"/>
                </el-form-item>
              </el-form>
              <div slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" plain @click="dialogFormNewPost = false">
                  Hủy bỏ
                </el-button>
                <el-button type="primary" icon="el-icon-refresh" plain @click="resetForm('dataForm')">
                  Đặt lại
                </el-button>
                <el-button type="success" icon="el-icon-check" plain @click="createRent">
                  Đồng ý
                </el-button>
              </div>
            </el-dialog>

            <el-dialog :close-on-click-modal="false" :close-on-press-escape="false" title="PHÒNG TRỌ - CHỈNH SỬA" :visible.sync="dialogFormEditPost">
              <el-form ref="dataForm" :model="formEdit" label-position="left" label-width="150px">
                <el-form-item
                  label="Tên"
                  prop="name"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập tên phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" v-model="formEdit.name" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="Tầng"
                  prop="floor"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập tầng của phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" v-model="formEdit.floor" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="Số lượng tối đa"
                  prop="max"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập số lượng người tối đa trong phòng !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" v-model="formEdit.max" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="ID phòng"
                  prop="motel_id"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập id phòng !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" v-model="formEdit.motel_id" :disabled="false"></el-input>
                </el-form-item>

                <el-form-item
                  label="Thành tiền"
                  prop="price"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập số tiền tương ứng !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" @keyup.native="handleAmountInput" v-model="formEdit.price" :disabled="false" :maxlength="15"></el-input>
                </el-form-item>

                <el-form-item
                  label="Trạng thái"
                  prop="status"
                  :rules="[
                    { required: true, message: 'Vui lòng chọn trạng thái phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-select v-if="formEdit" v-model="formEdit.status">
                    <el-option
                      v-for="item in optionStatus"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                    </el-option>
                  </el-select>
                </el-form-item>

                <el-form-item
                  label="Mô tả"
                  prop="description"
                  :rules="[
                    { required: true, message: 'Vui lòng nhập mô tả phòng trọ !', trigger: 'blur' }
                  ]">
                  <el-input v-if="formEdit" v-model="formEdit.description" :autosize="{ minRows: 2, maxRows: 4}" type="textarea"/>
                </el-form-item>
              </el-form>
              <div slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" plain @click="dialogFormEditPost = false">
                  Hủy bỏ
                </el-button>
                <el-button type="primary" icon="el-icon-refresh" plain @click="resetForm('dataForm')">
                  Đặt lại
                </el-button>
                <el-button type="success" icon="el-icon-check" plain @click="editRent">
                  Đồng ý
                </el-button>
              </div>
            </el-dialog>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import { fetchList, create, edit, remove } from '@/api/rent'
import { mapGetters } from 'vuex'
import Loading from '@/components/Loading'

const defaultCreate = { name: '', floor: '', max: '', motel_id: '', price: '', description: '', status: '' }

export default {
  name: 'Phongtro',
  components: {
    Loading
  },
  data() {
    return {
      optionStatus: [
        {
          value: 1,
          label: 'Ngừng hoạt động'
        },
        {
          value: 2,
          label: 'Đang bảo trì'
        },
        {
          value: 3,
          label: 'Đang hoạt động'
        }
      ],
      initing: false,
      changing: false,
      dialogFormEditPost: false,
      dialogConfirmRemove: false,
      toRemove: [{ id: 0, name: null }],
      multipleSelection: [],
      isRemoveMultiple: false,
      createForm: JSON.parse(JSON.stringify(defaultCreate)),
      formEdit: null,
      dialogFormNewPost: false,
      tableData: [],
      search: '',
      options: [],
      showInputSearch: false,
      pagination: {
        current_page: 1,
        per_page: 0,
        total: 0
      }
    }
  },
  computed: {
    ...mapGetters([
      'avatar',
      'rents'
    ])
  },
  mounted () {
    this.getApi()
  },
  watch: {
    '$route': {
      handler: function(nextValue) {
        const { path } = nextValue
        if (path === "/phong-tro/index") {
          this.getApi()
        }
      },
      deep: true,
      immediate: true
    },
    showInputSearch(value) {
      if (value) {
        document.body.addEventListener('click', this.close);
      } else {
        document.body.removeEventListener('click', this.close);
      }
    }
  },
  methods: {
    clickShowInputSearch() {
      this.showInputSearch = !this.showInputSearch
      if (this.showInputSearch) {
        this.$refs.headerSearchSelect && this.$refs.headerSearchSelect.focus()
      }
    },
    closeShowInputSearch() {
      this.$refs.headerSearchSelect && this.$refs.headerSearchSelect.blur()
      this.options = []
      this.showInputSearch = false
    },
    changeShowInputSearch(val) {
      this.$router.push(val.path)
      this.search = ''
      this.options = []
      this.$nextTick(() => {
        this.showInputSearch = false
      })
    },
    handleCurrentChange(val) {
      this.pagination.current_page = val
      this.getApi(val)
    },
    async getApi(current_page = 1, limit = 10) {
      this.initing = true
      const data = await this.$store.dispatch('rent/FetchList', { current_page, limit }).then(res => {
        this.tableData = res.data && res.data.data
        this.initing = false
        const api_current_page = res.data.current_page
        const total = res.data.total
        const per_page = res.data.per_page
        this.updatePagination(api_current_page, total, per_page)
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
    onSubmit() {},
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
    editRent() {
      this.$refs['dataForm'].validate(valid => {
        if (valid) {
          const editForm = this.createDataForm(this.formEdit)
          edit(editForm).then(res => {
            this.dialogFormEditPost = false
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
    createRent() {
      this.$refs['dataForm'].validate(valid => {
        if (valid) {
          this.createForm.price = parseInt(this.createForm.price.replace(/,/g, ''))
          console.log(this.createForm)
          create(this.createForm).then(res => {
            console.log(res)
            this.createForm = JSON.parse(JSON.stringify(defaultCreate))
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
    removeRent(id) {
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
    multipleRemovalRent() {
      this.toRemove.forEach(element => {
        this.removeRent(element.id)
      })
      this.isRemoveMultiple = false
      this.multipleSelection = []
      this.toRemove = []
    },
    handleChangeActions(items) {
      const { type, data } = items
      switch (type) {
        case 'edit':
          this.formEdit = data
          this.dialogFormEditPost = true
          break
        case 'create':
          this.createForm = {
            name: '',
            floor: '',
            max: '',
            motel_id: '',
            price: '',
            description: ''
          }
          this.dialogFormNewPost = true
          break
        default:
          break
      }
    },
    handleAmountInput() {
      let num = this.createForm.price.replace(/[^\d]+/g, '')
      num = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
      this.createForm.price = num
    },
    resetForm(dataForm) {
      this.$refs[dataForm].resetFields()
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
.header-search {
  font-size: 0 !important;

  .search-icon {
    cursor: pointer;
    font-size: 18px;
    vertical-align: middle;
  }

  .header-search-select {
    font-size: 18px;
    transition: width 0.2s;
    width: 0;
    overflow: hidden;
    background: transparent;
    border-radius: 0;
    display: inline-block;
    vertical-align: middle;

    /deep/ .el-input__inner {
      border-radius: 0;
      border: 0;
      padding-left: 0;
      padding-right: 0;
      box-shadow: none !important;
      border-bottom: 1px solid #d9d9d9;
      vertical-align: middle;
    }
  }

  &.show {
    .header-search-select {
      width: 210px;
      margin-left: 10px;
      margin-right: 10px;
    }
  }
}
</style>
