<template>
  <div class="app-container">
    <Loading v-if="initing"/>

    <div class="content" v-else>
      <el-row :gutter="24">

        <el-col :span="24" :xs="24">
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
              border fit
              style="width: 100%"
              @selection-change="handleSelectionChange">
              <el-table-column width="65px" align="center">
                <template slot-scope="scope">
                  <i v-if="scope.row.changing" class="el-icon-loading" />
                  <el-dropdown trigger="click">
                    <el-button type="info" size="small" plain>
                      <i class="el-icon-setting" />
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item>Sửa</el-dropdown-item>
                      <el-dropdown-item>Xóa</el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </template>
              </el-table-column>
              <el-table-column label="Tên dịch vụ">
                <template slot-scope="scope">{{ scope.row.date }}</template>
              </el-table-column>

              <el-table-column property="address" label="Tên phòng">
              </el-table-column>

              <el-table-column property="address" label="Đơn giá cố định">
              </el-table-column>

              <el-table-column property="address" label="Đơn vị">
              </el-table-column>

              <el-table-column property="address" label="Mô tả">
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
import Loading from '@/components/Loading'

export default {
  name: 'Dichvu',
  components: {
    Loading
  },
  data() {
    return {
      changing: false,
      initing: false,
      loading: false,
      tableData: []
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
  methods: {
    onSubmit() {},
    handleSelectionChange(val) {
      this.multipleSelection = val
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
</style>

