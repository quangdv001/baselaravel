<template>
  <div class="app-container">
    <div v-if="user">
      <el-row :gutter="24">

        <!-- <el-col :span="6" :xs="24">
          <user-card :user="user" />
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
              <el-button class="filter-item" style="border-color: #fbc4c4 !important; box-shadow: 0px 1px 5px 0px rgb(251, 196, 196) !important;" type="default" icon="el-icon-delete" size="mini" plain round>
                Xóa nhiều
              </el-button>
            </div>

            <el-table :data="tableData" border fit style="width: 100%">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row._changing" class="el-icon-loading" />
                  <div v-else>
                    <el-dropdown trigger="click" @command="handleChangeActions">
                      <el-button type="info" size="small" plain>
                        <i class="el-icon-setting" />
                      </el-button>
                      <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item :command="{ type: 'edit' }">Sửa</el-dropdown-item>
                        <el-dropdown-item :command="{ type: 'newpost' }">Đăng bài</el-dropdown-item>
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>

              <el-table-column type="selection" width="45"/>

              <el-table-column property="from" label="Địa chỉ" width="203">
                <template slot-scope="scope">{{ scope.row.from }}</template>
              </el-table-column>

              <el-table-column property="area" label="Diện tích" width="203" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.area }}</template>
              </el-table-column>

              <el-table-column property="start_date" label="Thuê ngày" width="203" show-overflow-tooltip>
              </el-table-column>

              <el-table-column property="end_date" label="Đến ngày" width="203" show-overflow-tooltip>
              </el-table-column>

              <el-table-column property="phone" label="Số điện thoại" width="203" show-overflow-tooltip>
              </el-table-column>

              <el-table-column width="55">
                <el-button type="info" size="small" circle>
                  <i class="el-icon-upload2" />
                </el-button>
              </el-table-column>

              <el-table-column width="55">
                <el-button type="danger" size="small" circle>
                  <i class="el-icon-delete" />
                </el-button>
              </el-table-column>
            </el-table>

            <el-dialog title="NHÀ TRỌ - CHỈNH SỬA" :visible.sync="dialogFormVisible">
              <el-form ref="form" :model="form" label-width="120px">
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Địa chỉ">
                      <el-input v-model="form.add" :disabled="true"/>
                    </el-form-item>
                  </el-col>
                  <el-col :span="12">
                    <el-form-item label="SĐT">
                      <el-input v-model="form.phone" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Diện tích">
                      <el-input v-model="form.dientich" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                  <el-col :span="12">
                    <el-form-item label="Mô tả">
                      <el-input v-model="form.description" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-form-item label="Thuê từ">
                  <el-date-picker
                    v-model="form.date1"
                    type="date"
                    placeholder="Chọn ngày"
                  />
                </el-form-item>
                <el-form-item label="Đến ngày">
                  <el-date-picker
                    v-model="form.date2"
                    type="date"
                    placeholder="Chọn ngày"
                  />
                </el-form-item>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" @click="dialogFormVisible = false" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button type="primary" @click="dialogFormVisible = false" icon="el-icon-check" plain>Đồng ý</el-button>
              </span>
            </el-dialog>

            <el-dialog title="NHÀ TRỌ - ĐĂNG BÀI" :visible.sync="dialogFormNewPost">
              <el-form ref="form" :model="form" label-width="150px">
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Tiêu đề bài đăng * :">
                      <input type="text" v-model="form.add" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                  <el-col :span="12">
                    <el-form-item label="Số điện thoại * :">
                      <input type="text" v-model="form.phone" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Diện tích nhà trọ * :">
                      <input type="text" v-model="form.dientich" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                  <el-col :span="12">
                    <el-form-item label="Mô tả * :">
                      <input type="text" v-model="form.description" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Địa chỉ * :">
                      <input type="text" v-model="form.description" :disabled="false"/>
                    </el-form-item>
                  </el-col>
                </el-row>
              </el-form>
              <span slot="footer" class="dialog-footer">
                <el-button type="info" icon="el-icon-circle-close" @click="dialogFormNewPost = false" plain>Hủy bỏ</el-button>
                <el-button type="primary" icon="el-icon-check" @click="createMotel" plain>Đồng ý</el-button>
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
import { fetchList, create } from '@/api/motel'
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
      items: [],
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
        from: 'Số 3, ngách 12, ngõ 67 đường Nguyễn Trãi',
        area: '40m2',
        phone: '0971064367',
        start_date: '12/02/2018',
        end_date: '12/02/2019'
      }, {
        from: 'Số 4, ngách 12, ngõ 67 đường Nguyễn Trãi',
        area: '40m2',
        phone: '0971064367',
        start_date: '12/02/2018',
        end_date: '12/02/2019'
      }, {
        from: 'Số 5, ngách 12, ngõ 67 đường Nguyễn Trãi',
        area: '40m2',
        phone: '0971064367',
        start_date: '12/02/2018',
        end_date: '12/02/2019'
      }, {
        from: 'Số 6, ngách 12, ngõ 67 đường Nguyễn Trãi',
        area: '40m2',
        phone: '0971064367',
        start_date: '12/02/2018',
        end_date: '12/02/2019'
      }, {
        from: 'Số 73, ngách 12, ngõ 67 đường Nguyễn Trãi',
        area: '40m2',
        phone: '0971064367',
        start_date: '12/02/2018',
        end_date: '12/02/2019'
      }]
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
      const data = await fetchList()
      console.log('get api', data)
    },
    createMotel() {
      console.log('tạo nhà trọ')
      create().then(res => {
        console.log(res)
      })
    },
    onSubmit() {},
    handleChangeActions(items) {
      const { type } = items
      switch (type) {
        case 'edit':
          this.dialogFormVisible = true
          break
        case 'newpost':
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
