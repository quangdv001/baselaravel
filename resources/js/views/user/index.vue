<template>
  <div class="app-container">
    <div v-if="user">
      <el-row :gutter="20">

        <el-col :span="6" :xs="24">
          <user-card :user="user" />
        </el-col>

        <el-col :span="18" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>QUẢN LÝ USER/ADMIN</span>
            </div>
            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button style="border-color: #b3d8ff !important;" plain round class="filter-item" type="default" icon="el-icon-plus" size="mini">
                Thêm mới
              </el-button>

              <!-- Xóa nhiều -->
              <el-button class="filter-item" style="border-color: #fbc4c4 !important; box-shadow: 0px 1px 5px 0px rgb(251, 196, 196) !important;" type="default" icon="el-icon-delete" size="mini" plain round>
                Xóa nhiều
              </el-button>

              <el-button style="border-color: #b3d8ff !important;" plain round class="filter-item" type="default" icon="el-icon-setting" size="mini">
                Lọc
              </el-button>
            </div>

            <el-table :data="tableData" border fit style="width: 100%">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row._changing" class="el-icon-loading" />
                  <div v-else>
                    <el-dropdown trigger="click">
                      <el-button type="info" size="small" plain>
                        <i class="el-icon-setting" />
                      </el-button>
                      <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>Sửa</el-dropdown-item>
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>

              <el-table-column type="selection" width="45" />

              <el-table-column property="name" label="Họ và tên" width="203">
                <template slot-scope="scope">{{ scope.row.name }}</template>
              </el-table-column>

              <el-table-column property="phone" label="Số điện thoại" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.phone }}</template>
              </el-table-column>

              <el-table-column property="birth" label="Sinh ngày" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.birth }}</template>
              </el-table-column>

              <el-table-column property="address" label="Gói tài khoản" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.address }}</template>
              </el-table-column>

              <el-table-column property="start_date" label="Ngày bắt đầu" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.start_date }}</template>
              </el-table-column>

              <el-table-column property="end_date" label="Ngày hết hạn" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.end_date }}</template>
              </el-table-column>

              <el-table-column width="55">
                <el-button type="danger" size="small" circle>
                  <i class="el-icon-delete" />
                </el-button>
              </el-table-column>
            </el-table>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import UserCard from '@/views/profile/components/UserCard'

export default {
  name: 'User',
  components: {
    UserCard
  },
  data() {
    return {
      user: {
        name: 'username',
        role: 'admin|user',
        email: 'user@test.com',
        avatar: this.avatar
      },
      form: {
        add: 'Số 123, ngõ 4, Quận 3',
        phone: '0234.123.456',
        dientich: '40 m2',
        description: 'Phòng mới xây',
        date1: '',
        date2: ''
      },
      tableData: [{
        name: 'Lê Văn Nam',
        phone: '0971064367',
        address: 'BASIC',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }, {
        name: 'Lê Văn A',
        phone: '0971064367',
        address: 'VIP',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }, {
        name: 'Lê Văn B',
        phone: '0971064367',
        address: 'BASIC',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }, {
        name: 'Lê Văn V',
        phone: '0971064367',
        address: 'VIP',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }, {
        name: 'Lê Văn C',
        phone: '0971064367',
        address: 'BASIC',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }, {
        name: 'Lê Văn E',
        phone: '0971064367',
        address: 'BASIC',
        birth: '12/5/1995',
        start_date: '05/07/2018',
        end_date: '05/07/2019'
      }]
    }
  },
  computed: {
    ...mapGetters([
      'avatar'
    ])
  },
  methods: {
    onSubmit() {}
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
</style>
