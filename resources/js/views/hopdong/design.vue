<template>
  <div class="app-container">
    <Loading v-if="initing"/>
    <div class="content" v-else>
      <el-row :gutter="24">
        <el-col :span="24" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>HỢP ĐỒNG</span>
            </div>

            <div class="filter-container">
              <!-- Thêm mới -->
              <el-button
                style="border-color: #b3d8ff !important;"
                class="filter-item"
                type="default"
                icon="el-icon-plus"
                size="mini"
                plain
                round
              >
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
              <!-- Tìm kiếm -->
              <!-- <el-input
                placeholder="Tìm kiếm"
                style="border-color: #b3d8ff !important;"
                class="filter-item"
                v-model="search"
                clearable>
              </el-input> -->

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
                style="border-color: #fbc4c4 !important; box-shadow: 0px 1px 5px 0px rgb(251, 196, 196) !important;"
                type="danger"
                icon="el-icon-delete"
                size="mini"
                plain
                round
              >
                Xóa nhiều
              </el-button>
            </div>

            <div class="filter-container" style="margin-bottom:20px;">
              <el-col class="item-check-room">
                <span style="margin-right: 10px">Loại HĐ : </span>
                <el-checkbox-group v-model="checkboxVal" size="mini">
                  <el-checkbox label="setroom">
                    Thuê phòng
                  </el-checkbox>
                  <el-checkbox label="prepaid">
                    Đặt cọc phòng
                  </el-checkbox>
                  <el-checkbox label="all-room">
                    Tất cả
                  </el-checkbox>
                </el-checkbox-group>
              </el-col>
              <el-col class="item-check-status">
                <span style="margin-right: 10px">Trạng thái : </span>
                <el-checkbox-group v-model="checkboxVal" size="mini">
                  <el-checkbox label="default">
                    Còn hiệu lực
                  </el-checkbox>
                  <el-checkbox label="end">
                    Hết hiệu lực
                  </el-checkbox>
                  <el-checkbox label="all-status">
                    Tất cả
                  </el-checkbox>
                </el-checkbox-group>
              </el-col>
            </div>

            <el-table
              :data="tableData"
              border fit
              style="width: 100%"
              @selection-change="handleSelectionChange">
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
                        <el-dropdown-item>Xóa</el-dropdown-item>
                      </el-dropdown-menu>
                    </el-dropdown>
                  </div>
                </template>
              </el-table-column>
              <el-table-column label="Tên dịch vụ">
                <template></template>
              </el-table-column>

              <el-table-column property="address" label="Tên phòng">
                <template></template>
              </el-table-column>

              <el-table-column property="address" label="Đơn giá cố định">
                <template></template>
              </el-table-column>

              <el-table-column property="address" label="Đơn vị">
                <template></template>
              </el-table-column>

              <el-table-column property="address" label="Mô tả"> 
                <template></template>
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
const defaultFormThead = ['setroom', 'default']

export default {
  name: 'Hopdong',
  components: {
    Loading
  },
  data() {
    return {
      initing: false,
      loading: false,
      checkboxVal: defaultFormThead,
      tableData: []
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

.item-check-room {
  display: flex;
  justify-content: flex-start;
}

.item-check-status {
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
</style>
