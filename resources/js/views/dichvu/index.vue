<template>
  <div class="app-container">
    <div v-if="user">
      <el-row :gutter="24">

        <el-col :span="6" :xs="24">
          <user-card :user="user" />
        </el-col>

        <el-col :span="18" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>DỊCH VỤ</span>
            </div>

            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button style="border-color: #b3d8ff !important;" type="default" icon="el-icon-plus" size="mini" plain round>
                Thêm mới
              </el-button>
            </div>

            <el-table
              :data="tableData"
              style="width: 100%"
            >
              <el-table-column width="55px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row.changing" class="el-icon-loading" />
                  <div v-else>
                    <el-dropdown trigger="click">
                      <el-button type="info" size="small" plain>
                        <i class="el-icon-setting" />
                      </el-button>
                      <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>Sửa</el-dropdown-item>
                        <el-dropdown-item>Xóa</el-dropdown-item>
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>
              <el-table-column label="Tên dịch vụ" width="203">
                <template slot-scope="scope">{{ scope.row.date }}</template>
              </el-table-column>

              <el-table-column property="address" label="Tên phòng" width="203" show-overflow-tooltip />

              <el-table-column property="address" label="Đơn giá cố định" width="203" show-overflow-tooltip />

              <el-table-column property="address" label="Đơn vị" width="203" show-overflow-tooltip />

              <el-table-column property="address" label="Mô tả" width="203" show-overflow-tooltip />
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
  name: 'Dichvu',
  components: {
    UserCard
  },
  data() {
    return {
      changing: false,
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
      }]
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

