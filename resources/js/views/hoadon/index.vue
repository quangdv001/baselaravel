<template>
  <div class="app-container">
    <Loading v-if="initing"/>

    <div class="content" v-else>
      <el-row :gutter="24">

        <el-col :span="24" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>{{ PAGE_TITLE }}</span>
            </div>
            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button @click="dialogFormNewPost = true" plain round class="filter-item" type="default" icon="el-icon-plus" size="mini">
                Thêm mới
              </el-button>
              
              <!-- Xuất excel -->
              <el-button
              class="bordered filter-item"
              type="default"
              icon="el-icon-download"
              size="mini"
              @click="handleExportExcel"
              plain
              round>
                Xuất excel
              </el-button>

              <!-- Tìm kiếm -->
              <el-button class="bordered filter-item" type="default" icon="el-icon-search" size="mini" plain round>
                Tìm kiếm
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
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>

              <el-table-column type="selection" width="45"/>

              <el-table-column label="STT" type="index" />

              <el-table-column property="title" :label="'Tên ' + PAGE_TITLE.toLowerCase()">
                <template slot-scope="scope">{{ scope.row.title }}</template>
              </el-table-column>

              <el-table-column property="img" label="Ảnh">
                <template slot-scope="scope"><img class="img-thumb" :src="scope.row.img" alt="" srcset=""></template>
              </el-table-column>

              <el-table-column property="short_description" label="Mô tả ngắn">
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.short_description">{{ scope.row.short_description }}</span>
                </template>
              </el-table-column>
              
              <el-table-column property="status" label="Trạng thái">
                <template slot-scope="scope">
                  <el-tag type="info" effect="dark" v-if="!scope.row.status">Chờ duyệt</el-tag>
                  <el-tag type="success" effect="dark" v-else>Đã đăng</el-tag>
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

            <el-dialog
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            :title="PAGE_TITLE + ' - XÓA'"
            :visible.sync="dialogConfirmRemove">
              <el-alert
                title="Xác nhận xóa"
                type="error"
                :closable="false"
                show-icon>
                <template slot>
                  <span v-if="toRemove.length === 1">Bạn có muốn xóa {{ PAGE_TITLE.toLowerCase() }}: <strong>{{toRemove[0].title}}</strong> không?</span>
                  <div v-else-if="toRemove.length > 1">
                    <p>Bạn có muốn xóa những {{ PAGE_TITLE.toLowerCase() }} sau không?</p>
                    <ul>
                      <li v-for="item in toRemove" :key="'remove-' + item.id">{{ item.title }}</li>
                    </ul>
                  </div>
                </template>
              </el-alert>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" @click="isRemoveMultiple = dialogConfirmRemove = false" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button v-if="!isRemoveMultiple" type="primary" @click="removeItem(toRemove[0].id)" icon="el-icon-check" plain>Đồng ý</el-button>
                <el-button v-else type="primary" @click="multipleRemovalItem" icon="el-icon-check" plain>Đồng ý</el-button>
              </span>
            </el-dialog>

            <el-dialog 
              width="90%"
              :before-close="handleClosePopup"
              :close-on-click-modal="false"
              :close-on-press-escape="false"
              :title="PAGE_TITLE + ' - ' + formTitle.toUpperCase() "
              :visible.sync="dialogFormNewPost">
              <el-form ref="form" :model="formCreate" :rules="rules" label-position="left" label-width="150px">
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item
                      label="Tiêu đề"
                      prop="title">
                      <el-input
                        v-model="formCreate.title"
                        @change="createNewSlug"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Slug"
                      prop="slug">
                      <el-input
                        v-model="formCreate.slug"
                        @change="createNewSlug"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Mô tả"
                      prop="short_description">
                      <el-input
                        v-model="formCreate.short_description"
                        type="textarea"
                        :rows="2"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Hình ảnh"
                      prop="img">
                      <input ref="uploadFile" type="file" @change="handleUpload">
                      <img style="width:120px; height:80px; border: 2px solid #fefefe" v-if="formCreate.img" :src="formCreate.img" alt="">
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Nội dung"
                      prop="description">
                      <Tinymce v-if="isShowEditor" ref="editor" v-model="formCreate.description" :height="400" />
                    </el-form-item>
                  </el-col>                  

                </el-row>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" @click="dialogFormNewPost = false" plain>Hủy bỏ</el-button>
                <el-button type="primary" icon="el-icon-refresh" @click="resetForm('form')" plain>Đặt lại</el-button>
                <el-button type="success" icon="el-icon-check" @click="handleSubmit" plain>{{ formTitle }}</el-button>
              </span>
            </el-dialog>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import { checkPrice, createSlug } from '@/utils'
import { mapGetters } from 'vuex'
import {  create, edit, remove } from '@/api/motel'
import Loading from '@/components/Loading'
import Tinymce from '@/components/Tinymce'

const LABEL = {
  name: 'HoaDon',
  title: 'HÓA ĐƠN',
  model: 'bill',
  slug: 'hoa-don',
  edit: 'Sửa',
  create: 'Tạo mới'
}


const CUSTOMIZE = {
  exportExcel: (list) => {
    const formatJson = (filterVal, jsonData) => {
      return jsonData.map(v => filterVal.map(j => {
        if (j === 'timestamp') {
          return parseTime(v[j])
        } else {
          return v[j]
        }
      }))
    }

    import('@/vendor/Export2Excel').then(excel => {
      const tHeader = ['Tên HĐ', 'Mã HĐ', 'Mô tả', 'Nội dung']
      const filterVal = ['title', 'img', 'short_description', 'description']
      const data = formatJson(filterVal, list) // list
      excel.export_json_to_excel({
        header: tHeader, //Header Required
        data, //Specific data Required
        filename: 'excel-list', //Optional
        autoWidth: true, //Optional
        bookType: 'xlsx' //Optional
      })
    })
  }
}

// 'motel_name', 'rent_name', 'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'rent_id', 'motel_id'
const defaultCreate = {
    title: '',
    slug: '',
    meta: '',
    type: '',
    short_description: '',
    note: '',
    status: '',
    category_id: '',
    img: '',
    file_path: ''
}

const rules = {
  title: [{ required: true, message: 'Vui lòng nhập tiêu đề!', trigger: 'blur' }],
  slug: [{ required: true, message: 'Không được để trống slug!', trigger: 'blur' }],
  short_description: [{ required: true, message: 'Vui lòng viết mô tả!', trigger: 'blur' }],
  img: [{ required: true, message: 'Vui lòng chọn hình ảnh!', trigger: 'blur' }],
  description: [{ required: true, message: 'Vui lòng nhập nội dung!', trigger: 'blur' }]
}

export default {
  name: LABEL.name,
  components: {
    Loading,
    Tinymce
  },
  data() {
    return {
      isShowEditor: true,
      rules,
      PAGE_TITLE: LABEL.title,
      formTitle: LABEL.create,
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
      'services'
    ])
  },
  mounted () {
    this.getApi()
  },
  watch: {
    '$route': {
      handler: function(nextValue) {
        const { path } = nextValue
        if (path === `/${LABEL.slug}/index`) {
          this.getApi()
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    createNewSlug (e) {
      this.formCreate.slug = createSlug(e)
    },
    handleUpload() {      
      const file = this.$refs.uploadFile.files
      var form_data = new FormData()
      form_data.append('file', file[0])
      const urlImage = this.$store.dispatch(LABEL.model + '/Upload', form_data).then(res => {
        if (res && res.success) {
          this.formCreate.img = res.img
        }
      })
    },
    handleExportExcel() {
      CUSTOMIZE.exportExcel(this.tableData)
    },
    handleCurrentChange(val) {
      this.pagination.current_page = val
      this.getApi(val)
    },
    async getApi(current_page = 1, limit = 10) {
      this.initing = true
      const data = await this.$store.dispatch(LABEL.model + '/FetchList', { current_page, limit }).then(res => {
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
    handleSelectionChange(val) {
      this.multipleSelection = val
    },
    handleSubmit() {
      this.formTitle === LABEL.edit ? this.editItem() : this.createItem()
    },
    editItem() {
      this.$refs['form'].validate(valid => {
        if (valid) {
          this.$store.dispatch(LABEL.model + '/Edit', this.formCreate).then(res => {
            if (res.success) {
              this.tableData = this.tableData.map(item => {
                if (item.id === res.data.id) return res.data
                return item
              })
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
        this.handleClosePopup()
      })
    },
    createItem() {
      this.$refs['form'].validate(valid => {
        if (valid) {
          const tableData = JSON.parse(JSON.stringify(this.tableData))
          this.$store.dispatch(LABEL.model + '/Create', this.formCreate).then(res => {
            if (res.success) {
              if (tableData && tableData.length === 0) tableData.push(res.data)
              else {
                if (!tableData.some(item => item.id === res.data.id)) { tableData.unshift(res.data) }
                const isRemoveEnd = tableData.length > this.pagination.per_page
                if (isRemoveEnd) {
                  ++this.pagination.total
                  tableData.pop()
                }
              }
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
          
          this.tableData = tableData          
          this.handleClosePopup()
        } else {
          return false
        }
      })
    },
    handleClosePopup() {      
      setTimeout(() => {
        this.formTitle = LABEL.create
        this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
        this.dialogFormNewPost = false
        this.resetForm()
      }, 400)
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
    removeItem(id) {
      if (!id) return
      this.$store.dispatch(LABEL.model + '/Remove', id).then(res => {
        this.dialogConfirmRemove = false
        if (res.success) {
          this.tableData = this.tableData.filter(item => (item.id !== id))
          this.getApi(this.pagination.current_page)
        }
        this.$notify.success({
          title: 'Thành công',
          message: 'Mục bạn chọn đã được xóa !',
          duration: 4000
        })
      })
      .catch(_err => {
        console.warn(_err)
        this.initing = false
        this.$notify.error({
          title: 'Lỗi',
          message: 'Đang gặp sự cố, vui lòng báo hệ thống xử lý!',
          duration: 4000
        })
      })
      this.toRemove = []
    },
    multipleRemovalItem() {
      this.toRemove.forEach(element => {
        this.removeItem(element.id)
      })
      this.isRemoveMultiple = false
      this.multipleSelection = []
      this.toRemove = []
    },
    handleChangeActions(items) {
      const { type, data } = items
      switch (type) {
        case 'edit':
          this.formTitle = LABEL.edit
          this.formCreate = JSON.parse(JSON.stringify(data))
          this.dialogFormNewPost = true
          break
        case 'create':
          this.formTitle = LABEL.create
          this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
          this.dialogFormNewPost = true
          break
        default:
          break
      }
    },
    resetForm() {
      this.$refs['form'].resetFields()
      if (this.$refs.uploadFile && this.$refs.uploadFile.files) {
        const input = this.$refs.uploadFile
        input.type = 'text'
        input.type = 'file'
      }
      if (this.$refs.editor) {
        this.isShowEditor = false
        setTimeout(() => { this.isShowEditor = true }, 300)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.img-thumb {
  width: 60px;
  height: 40px;
  box-shadow: 0 2px 3px rgba(179, 216, 255, 30%)
}
/deep/ .upload-container.editor-upload-btn {
  display: none;
}
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
