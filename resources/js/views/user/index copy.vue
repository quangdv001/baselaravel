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
              <el-button @click="dialogFormNewPost = true" style="border-color: #b3d8ff !important;" plain round class="filter-item" type="default" icon="el-icon-plus" size="mini">
                Thêm mới
              </el-button>
              <!-- Xuất excel -->
              <el-button
                class="filter-item"
                style="border-color: #b3d8ff !important;"
                type="default"
                icon="el-icon-printer"
                size="mini"
                plain
                round
              >
                Xuất excel
              </el-button>

              <!-- Đánh dấu xóa -->
              <el-button
                class="filter-item"
                style="border-color: #b3d8ff !important;"
                type="default"
                icon="el-icon-check"
                size="mini"
                plain
                round
              >
                Đánh dấu xóa
              </el-button>

              <!-- Hủy đánh dấu -->
              <el-button
                class="filter-item"
                style="border-color: #b3d8ff !important;"
                type="default"
                icon="el-icon-upload2"
                size="mini"
                plain
                round
              >
                Hủy đánh dấu
              </el-button>

              <el-button
                class="filter-item"
                style="border-color: #b3d8ff !important;"
                type="default"
                icon="el-icon-search"
                size="mini"
                plain
                round
              >
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

              <el-table-column property="name" :label="'Tên ' + PAGE_TITLE.toLowerCase()">
                <template slot-scope="scope">{{ scope.row.name }}</template>
              </el-table-column>

              <!-- <el-table-column property="deposits" label="Đặt cọc">
                <template slot-scope="scope">{{ scope.row.deposits | formatMoney }} vnđ</template>
              </el-table-column>

              <el-table-column property="note" label="Ghi chú">
                <template slot-scope="scope">
                  <span v-if="scope && scope.row.note">{{ scope.row.note }}</span>
                </template>
              </el-table-column> -->

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

            <el-dialog :title="PAGE_TITLE + ' - XÓA'" :visible.sync="dialogConfirmRemove">
              <el-alert
                title="Xác nhận xóa"
                type="error"
                :closable="false"
                show-icon>
                <template slot>
                  <span v-if="toRemove.length === 1">Bạn có muốn xóa {{ PAGE_TITLE.toLowerCase() }}: <strong>{{toRemove[0].title}}</strong> không?</span>
                  <div v-else-if="toRemove.length > 1">
                    <p>Bạn có muốn xóa những mục sau không?</p>
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
              :title="PAGE_TITLE + ' - ' + formLabel.toUpperCase()"
              :visible.sync="dialogFormNewPost"
              :before-close="handleClose">
              <el-form ref="form" :model="formCreate" :rules="ruleForm" label-position="top">
                <el-row :gutter="20">
                  <el-col :span="24">
                    <el-form-item
                      :label="'Tên ' + PAGE_TITLE.toLowerCase()"
                      prop="name">
                      <el-input
                        v-model="formCreate.name"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                  <el-col :span="12">
                    <el-form-item
                      label="Thời hạn thanh toán"
                      prop="payment_period">
                      <el-input
                        v-model="formCreate.payment_period"
                        type="number"
                        :min="0"
                        :disabled="false" />
                    </el-form-item>
                  </el-col>

                  <el-col :span="12">
                    <el-form-item
                      label="Đơn vị"
                      prop="unit">                       
                        <el-select v-model="unitOptions[0].value" placeholder="Select">
                            <el-option
                            v-for="item in unitOptions"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                  </el-col>

                  <el-col :span="12">
                    <el-form-item
                      label="Đặt cọc (vnđ)"
                      prop="deposits">
                      <el-input
                        v-model="formCreate.deposits"
                        type="number"
                        :min="0"
                        :disabled="false" />
                    </el-form-item>
                  </el-col>

                  <el-col :span="12">
                    <el-form-item
                      label="Thời gian hiệu lực"
                      prop="duration">
                      <el-input
                        v-model="formCreate.duration"
                        type="number"
                        :min="0"
                        :disabled="false" />
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      class="date"
                      :label="'Thời gian ' + PAGE_TITLE.toLowerCase()"
                      prop="date">
                      <el-date-picker
                        width="100%"
                        size="large"
                        @change="onDateTimeChange"
                        v-model="dateTimeRange"
                        type="daterange"
                        format="dd-MM-yyyy"
                        range-separator="-"
                        start-placeholder="Ngày bắt đầu"
                        end-placeholder="Ngày hết hạn">
                      </el-date-picker>
                    </el-form-item>
                  </el-col>

                  <el-col :span="16">
                    <el-form-item label="Bên B" prop="rent_id">
                      <el-select
                          v-model="formCreate.rent_id"
                          _multiple
                          filterable
                          remote
                          reserve-keyword
                          placeholder="Nhập tên"
                          :remote-method="remoteMethod"
                          :loading="rentLoading">
                          <el-option
                            v-for="item in rentOptions"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">                            
                            <span style="float: left">{{ item.name }}</span>
                            <span style="float: right; color: #8492a6; font-size: 13px">{{ item.id }}</span>
                          </el-option>
                        </el-select>
                    </el-form-item>
                  </el-col>

                  <el-col :span="8">
                    <el-form-item label="Trạng thái" prop="status">
                      <el-switch 
                      v-model="formCreate.status"
                      active-color="#13ce66"
                      inactive-color="#ff4949"
                      :active-value="1"
                      :inactive-value="0"></el-switch>
                    </el-form-item>
                  </el-col>

                  <el-col :span="24">
                    <el-form-item
                      label="Ghi chú"
                      prop="note">
                      <el-input
                        v-model="formCreate.note"
                        type="textarea"
                        :rows="2"
                        :disabled="false"/>
                    </el-form-item>
                  </el-col>

                </el-row>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" @click="handleClose" plain>Hủy bỏ</el-button>
                <el-button type="primary" icon="el-icon-refresh" @click="resetForm('form')" plain>Đặt lại</el-button>
                <el-button type="success" icon="el-icon-check" @click="handleSubmit" plain>{{ formLabel }}</el-button>
              </span>
            </el-dialog>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import { fetchList } from '@/api/motel'
import { mapGetters } from 'vuex'
import Loading from '@/components/Loading'

const unitOptions  = [{
  value: 'thang',
  label: 'Tháng'
}]

// 'name', 'floor', 'max', 'motel_id', 'price', 'description'
const defaultCreate = {
    name: '',
    description: '',
    floor: 0,
    duration: '',
    payment_period: '',
    start: '',
    end: '',
    status: 1,
    user_id: '',
    rent_id: ''
}

const checkPrice = (rule, _value, callback) => {
  const value = parseFloat(_value)
  if (value === 0) return callback()
  if (!value) {
    return callback(new Error('Phải là số lớn hơn hoặc bằng 0'))
  }
  setTimeout(() => {
    if (!Number.isInteger(value)) {
      callback(new Error('Vui lòng nhập số'))
    } else {
      if (value <= 0 ) {
        callback(new Error('Vui lòng nhập số lớn hơn hoặc bằng 0'))
      } else if (value > 10000000000) {
        callback(new Error('Vui lòng nhập số nhỏ hơn 10 tỷ'))
      } else {
        callback()
      }
    }
  }, 1000)
}

const ruleForm = {
  name: [{ required: true, message: 'Vui lòng nhập tên!', trigger: 'blur' }],
  description: [{ required: true, message: 'Vui lòng nhập mô tả!', trigger: 'blur' }],
  floor: [{ validator: checkPrice, trigger: 'blur' }],
  payment_period: [{ validator: checkPrice, trigger: 'blur' }]
}
const LABEL = {
  create : 'Tạo mới',
  edit: 'Sửa'
}
export default {
  name: 'Renter',
  components: {
    Loading
  },
  data() {
    return {
      rentOptions: [],
      rentLoading: false,
      rentList: [],
      PAGE_TITLE: 'KHÁCH TRỌ',
      dateTimeRange: [],
      initing: false,
      isEdit: false,
      dialogFormVisible: false,
      dialogFormNewPost: false,
      dialogConfirmRemove: false,
      toRemove: [{ id: 0, title: null }],
      unitOptions,
      formLabel: LABEL.create,
      formCreate: JSON.parse(JSON.stringify(defaultCreate)),
      ruleForm,
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
      'renters'
    ])
  },
  mounted () {
    this.getApi()
    this.getmotelList()
  },
  watch: {
    '$route': {
      handler: function(nextValue) {
        const { path } = nextValue
        if (path === "/user/index") {
          this.getApi()
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    getmotelList() {
      fetchList(1, 250).then(res => {
        if (res && res.data && res.data.data && res.data.data.length > 0)
        this.rentOptions = res.data.data
      })
    },
    remoteMethod(query) {
      if (query !== '') {
          this.rentLoading = true
          setTimeout(() => {
            this.rentLoading = false
            this.rentOptions = this.motelList.filter(item => {
              return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1
            });
          }, 200)
        } else {
          this.rentOptions = []
        }
    },
    handleCurrentChange(val) {
      this.pagination.current_page = val
      this.getApi(val)
    },
    async getApi(current_page = 1, limit = 10) {
      try { 
        this.initing = true
        const data = await this.$store.dispatch('renter/FetchList', { current_page, limit }).then(res => {
          this.tableData = res.data && res.data.data
          this.initing = false
          const api_current_page = res.data.current_page
          const total = res.data.total
          const per_page = res.data.per_page
          this.updatePagination(api_current_page, total, per_page)
        })
        return data
      } catch (error) {
        this.initing = false
        console.warn(error)
      }
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
    handleClose() {      
      this.dialogFormNewPost = false
      this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
      this.$refs['form'].clearValidate()
      setTimeout(() => {
        this.formLabel = LABEL.create
      }, 300)
    },
    onDateTimeChange(e) {
      console.log(e)
      this.formCreate.start = new Date(this.dateTimeRange[0]).getTime() / 1000
      this.formCreate.end = new Date(this.dateTimeRange[1]).getTime() / 1000
    },
    handleSelectionChange(val) {
      this.multipleSelection = val
    },
    handleSubmit() {
      if (this.formLabel === LABEL.create) {
        this.createItem()
      } else this.editItem()
    },
    editItem() {
      if (this.isEdit) return
      this.isEdit = true
      this.$refs['form'].validate(valid => {
        if (valid) {
          const editForm = this.formCreate
          this.$store.dispatch('renter/Edit', editForm).then(res => {
            if (res.success) {
              const row = res.data
              this.tableData = this.tableData.map(item => {
                if (item.id === row.id) return row
                return item
              })
            }
            this.$notify.success({
              title: 'Thành công',
              message: 'Dữ liệu được sửa thành công !',
              duration: 4000
            })
            this.handleClose()
            this.isEdit = false
          })
          .catch(_err => {
            console.warn(_err)
            this.isEdit = false
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
    createItem() {
      if (this.isEdit) return
      this.isEdit = true
      this.$refs['form'].validate(valid => {
        if (valid) {
          this.$store.dispatch('renter/Create', this.formCreate).then(res => {
            if (res.success) {
              if (this.tableData.length === 0) tableData.push(res.data)
              else if (!this.tableData.some(item => item.id === res.data.id)) {
                tableData.unshift(res.data)
                if (this.tableData && this.tableData.length > this.pagination.per_page) this.tableData.pop()
              }
            }
            this.$notify.success({
              title: 'Thành công',
              message: 'Dữ liệu tạo mới thành công !',
              duration: 4000
            })

            this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
            this.isEdit = false
            this.handleClose()
          })
          .catch(_err => {
            console.warn(_err)
            this.isEdit = false
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
      
      this.dialogFormNewPost && (this.dialogFormNewPost = false)
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
      this.$store.dispatch('renter/Remove', id).then(res => {
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
        this.isEdit = false
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
          this.formLabel = LABEL.edit
          this.formCreate = JSON.parse(JSON.stringify(data))
          this.dialogFormNewPost = true
          break
        case 'create':
          this.formLabel = LABEL.create
          this.formCreate = JSON.parse(JSON.stringify(defaultCreate))
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
.date {
  & /deep/  .el-range-editor {
    width: 100%;
  }
}
</style>
