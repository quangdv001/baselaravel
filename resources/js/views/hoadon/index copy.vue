<template>
  <div class="app-container">
    <Loading v-if="initing"/>

    <div class="content" v-else>
      <el-row :gutter="24">

        <el-col :span="24" :xs="24">
          <el-card style="margin-bottom:20px;">
            <div slot="header" class="clearfix">
              <span>HÓA ĐƠN</span>
            </div>

            <div class="filter-container" style="margin-bottom: 40px;">
              <el-col :span="12" class="item-check-room">
                <span style="margin-right: 10px">Tháng / năm : </span>
                <span class="dottedDate">07/2019</span>
              </el-col>
              <el-col :span="12" class="item-check-status">
                <span style="margin-right: 10px">Mã hợp đồng : </span>
                <span class="dottedDate">HD080706</span>
              </el-col>
            </div>

            <el-table
              :data="tableData"
              border fit
              style="width: 100%"
              @selection-change="handleSelectionChange">
              <el-table-column property="service" label="Tên dịch vụ">
                <template></template>
              </el-table-column>

              <el-table-column property="unit" label="Đơn vị">
                <template></template>
              </el-table-column>

              <el-table-column property="price" label="Đơn giá(vnđ)">
                <template></template>
              </el-table-column>

              <el-table-column property="amount" label="Số lượng">
                <template></template>
              </el-table-column>

              <el-table-column property="intomoney" label="Thành tiền">
                <template>
                  <el-input placeholder="" :disabled="true" />
                </template>
              </el-table-column>
            </el-table>

            <div class="filter-container" style="margin-top: 40px;">
              <el-row class="group-left">
                <div style="margin-bottom: 20px;">
                  <span style="margin-right: 10px">Tổng tiền dịch vụ : </span>
                  <span class="dottedGroup">850.000</span>
                </div>
                <div style="margin-bottom: 20px;">
                  <span style="margin-right: 10px">Chi phí khác : </span>
                  <span class="dottedGroup">0</span>
                </div>
                <div>
                  <span style="margin-right: 10px">Dư / nợ (cũ) : </span>
                  <span class="dottedGroup">0</span>
                </div>
              </el-row>

              <el-row class="group-right">
                <div style="margin-bottom: 20px;">
                  <span style="margin-right: 10px">Dư / nợ (mới) : </span>
                  <span class="dottedGroup">0</span>
                </div>
                <div>
                  <span style="margin-right: 10px">Thành tiền : </span>
                  <span class="dottedGroup">2.922.000</span>
                </div>
              </el-row>
            </div>

            <div class="group-button">
              <!-- Huỷ bỏ -->
              <el-button plain class="filter-item" type="info" icon="el-icon-circle-close" size="mini">
                Huỷ bỏ
              </el-button>

              <!-- Xuất hóa đơn -->
              <el-button plain class="filter-item" type="primary" icon="el-icon-printer" size="mini">
                Xuất hóa đơn
              </el-button>
            </div>
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
  name: 'Hoadon',
  components: {
    Loading
  },
  data() {
    return {
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
  methods: {
    onSubmit() {},
    handleSelectionChange(val) {
      this.multipleSelection = val
    }
  }
}
</script>

<style lang="scss" scoped>


.group-button {
  display: flex;
  justify-content: flex-end;
}

.item-check-status {
  display: flex;
  justify-content: flex-end;
}

.dottedDate {
  border-bottom: 2px dashed #606266;
}

.dottedGroup {
  border-bottom: 1px dashed #606266;
}

.group-left {
  display: block;
  padding-left: 20px;
  margin: auto;
  white-space: nowrap;
}

.group-right {
  display: block;
  padding-left: 40%;
  transform: translateY(-90px);
  margin: auto;
  white-space: nowrap;
}
</style>
