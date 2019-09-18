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

            <el-table :data="tableData" border style="width: 100%">
              <el-table-column property="service" label="Tên dịch vụ" width="213">
                <template slot-scope="scope">{{ scope.row.service }}</template>
              </el-table-column>

              <el-table-column property="unit" label="Đơn vị" width="213" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.unit }}</template>
              </el-table-column>

              <el-table-column property="price" label="Đơn giá(vnđ)" width="213" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.price }}</template>
              </el-table-column>

              <el-table-column property="amount" label="Số lượng" width="213" show-overflow-tooltip>
                <template slot-scope="scope">{{ scope.row.amount }}</template>
              </el-table-column>

              <el-table-column property="intomoney" label="Thành tiền" width="213" show-overflow-tooltip>
                <template slot-scope="scope">
                  <el-input :placeholder="scope.row.intomoney" :disabled="true" />
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
import UserCard from '@/views/profile/components/UserCard'

export default {
  name: 'Hoadon',
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
        service: 'Tiền nhà',
        unit: 'Phòng',
        price: '2.500.000',
        amount: '1',
        intomoney: '2.500.000'
      }, {
        service: 'Tiền điện',
        unit: 'Số(kWh)',
        price: '4.000',
        amount: '30',
        intomoney: '72.000'
      }, {
        service: 'Tiền nước',
        unit: 'Người',
        price: '70.000',
        amount: '2',
        intomoney: '140.000'
      }, {
        service: 'Xe máy',
        unit: 'Phòng',
        price: '100.000',
        amount: '1',
        intomoney: '100.000'
      }, {
        service: 'Vệ sinh',
        unit: 'Chiếc',
        price: '10.000',
        amount: '1',
        intomoney: '10.000'
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
