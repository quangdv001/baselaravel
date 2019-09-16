<template>
  <div class="app-container">
    <div v-if="user">
      <el-row :gutter="24">

        <el-col :span="5" :xs="24">
          <user-card :user="user" />
        </el-col>

        <el-col :span="19" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>PHÒNG TRỌ</span>
            </div>

            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button style="border-color: #b3d8ff !important;" plain round class="filter-item" type="default" icon="el-icon-plus" size="mini" @click="handleCreate">
                Thêm mới
              </el-button>

              <!-- Xuất hóa đơn -->
              <el-button class="filter-item" style="border-color: #b3d8ff !important;" type="default" icon="el-icon-printer" size="mini" plain round>
                Xuất hóa đơn
              </el-button>

              <!-- Thêm nhiều -->
              <el-button class="filter-item" style="border-color: #b3d8ff !important;" type="default" icon="el-icon-check" size="mini" plain round>
                Thêm nhiều
              </el-button>

              <!-- Nhập excel -->
              <el-button class="filter-item" style="border-color: #b3d8ff !important;" type="default" icon="el-icon-upload2" size="mini" plain round>
                Nhập excel
              </el-button>

              <!-- Xuất excel -->
              <el-button class="filter-item" style="border-color: #b3d8ff !important;" type="default" icon="el-icon-download" size="mini" plain round>
                Xuất excel
              </el-button>

              <!-- Tìm kiếm -->
              <el-button class="filter-item" style="border-color: #b3d8ff !important;" type="default" icon="el-icon-search" size="mini" plain round>
                Tìm kiếm
              </el-button>

              <!-- Xóa nhiều -->
              <el-button class="filter-item" style="border-color: #fbc4c4 !important; box-shadow: 0px 1px 5px 0px rgb(251, 196, 196) !important;" type="default" icon="el-icon-delete" size="mini" plain round>
                Xóa nhiều
              </el-button>
            </div>
            <el-table ref="multipleTable" :data="tableData" border fit style="max-width: 100%" highlight-current-row @selection-change="handleSelectionChange">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row.changing" class="el-icon-loading" />
                  <el-dropdown trigger="click">
                    <el-button type="info" size="small" plain>
                      <i class="el-icon-setting" />
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item>Sửa</el-dropdown-item>
                      <el-dropdown-item>Lưu</el-dropdown-item>
                      <el-dropdown-item>Trạng thái</el-dropdown-item>
                      <el-dropdown-item>Xóa</el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </template>
              </el-table-column>

              <el-table-column type="selection" width="55" />

              <el-table-column label="Tầng" width="145">
                <template slot-scope="scope">{{ scope.row.date }}</template>
              </el-table-column>

              <el-table-column property="name" label="Tên phòng" width="145" />

              <el-table-column property="address" label="Số lượng người" width="145" />

              <el-table-column property="address" label="Đơn giá" width="145" />

              <el-table-column property="address" label="Trạng thái" width="145" />

              <el-table-column property="address" label="Tạm dừng" width="145" />

              <el-table-column property="address" label="Mô tả" width="145" />
            </el-table>

            <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible">
              <el-form ref="dataForm" :rules="rules" :model="temp" label-position="left" label-width="70px" style="width: 400px; margin-left:50px;">
                <el-form-item label="Type" prop="type">
                  <el-select v-model="temp.type" class="filter-item" placeholder="Please select">
                    <el-option v-for="item in calendarTypeOptions" :key="item.key" :label="item.display_name" :value="item.key" />
                  </el-select>
                </el-form-item>
                <el-form-item label="Date" prop="timestamp">
                  <el-date-picker v-model="temp.timestamp" type="datetime" placeholder="Please pick a date" />
                </el-form-item>
                <el-form-item label="Title" prop="title">
                  <el-input v-model="temp.title" />
                </el-form-item>
                <el-form-item label="Status">
                  <el-select v-model="temp.status" class="filter-item" placeholder="Please select">
                    <el-option v-for="item in statusOptions" :key="item" :label="item" :value="item" />
                  </el-select>
                </el-form-item>
                <el-form-item label="Imp">
                  <el-rate v-model="temp.importance" :colors="['#99A9BF', '#F7BA2A', '#FF9900']" :max="3" style="margin-top:8px;" />
                </el-form-item>
                <el-form-item label="Remark">
                  <el-input v-model="temp.remark" :autosize="{ minRows: 2, maxRows: 4}" type="textarea" placeholder="Please input" />
                </el-form-item>
              </el-form>
              <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">
                  Cancel
                </el-button>
                <el-button type="primary" @click="dialogStatus==='create'?createData():updateData()">
                  Confirm
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
import { mapGetters } from 'vuex'
import UserCard from '@/views/profile/components/UserCard'

const calendarTypeOptions = [
  { key: 'CN', display_name: 'China' },
  { key: 'US', display_name: 'USA' },
  { key: 'JP', display_name: 'Japan' },
  { key: 'EU', display_name: 'Eurozone' }
]

// arr to obj, such as { CN : "China", US : "USA" }
const calendarTypeKeyValue = calendarTypeOptions.reduce((acc, cur) => {
  acc[cur.key] = cur.display_name
  return acc
}, {})

export default {
  name: 'Phongtro',
  components: {
    UserCard
  },
  filters: {
    // statusFilter(status) {
    //   const statusMap = {
    //     published: 'success',
    //     draft: 'info',
    //     deleted: 'danger'
    //   }
    //   return statusMap[status]
    // },
    typeFilter(type) {
      return calendarTypeKeyValue[type]
    }
  },
  data() {
    return {
      changing: false,
      calendarTypeOptions,
      statusOptions: ['published', 'draft', 'deleted'],
      temp: {
        id: undefined,
        importance: 1,
        remark: '',
        timestamp: new Date(),
        title: '',
        type: '',
        status: 'published'
      },
      dialogStatus: '',
      textMap: {
        update: 'Edit',
        create: 'Create'
      },
      dialogFormVisible: false,
      user: {
        name: 'username',
        role: 'admin|user',
        email: 'user@test.com',
        avatar: this.avatar
      },
      listQuery: {
        page: 1,
        limit: 20,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+id'
      },
      tableData: [{
        date: '2016-05-03',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-08',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-06',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-07',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }],
      rules: {
        type: [{ required: true, message: 'type is required', trigger: 'change' }],
        timestamp: [{ type: 'date', required: true, message: 'timestamp is required', trigger: 'change' }],
        title: [{ required: true, message: 'title is required', trigger: 'blur' }]
      }
    }
  },
  computed: {
    ...mapGetters([
      'avatar'
    ])
  },
  methods: {
    onSubmit() {},
    handleSelectionChange(val) {
      this.multipleSelection = val
    },
    resetTemp() {
      this.temp = {
        id: undefined,
        importance: 1,
        remark: '',
        timestamp: new Date(),
        title: '',
        status: 'published',
        type: ''
      }
    },
    handleCreate() {
      this.resetTemp()
      this.dialogStatus = 'create'
      this.dialogFormVisible = true
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.app-container {
  margin: 80px auto;
  max-width: 80% !important;
}

.filter-container {
  display: flex;
  justify-content: flex-end;
}

.el-button--mini.is-round:hover {
  box-shadow: 0px 1px 5px 0px rgb(179, 216, 255) !important;
}
</style>
