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
              <span>NHÀ TRỌ - CHỈNH SỬA</span>
            </div>
            <el-form ref="form" :model="form" label-width="120px">
              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="Địa chỉ">
                    <el-input v-model="form.add" :disabled="true" />
                  </el-form-item>
                </el-col>
                <el-col :span="12">
                  <el-form-item label="SĐT">
                    <el-input v-model="form.phone" :disabled="false" />
                  </el-form-item>
                </el-col>
              </el-row>
              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="Diện tích">
                    <el-input v-model="form.dientich" :disabled="false" />
                  </el-form-item>
                </el-col>
                <el-col :span="12">
                  <el-form-item label="Mô tả">
                    <el-input v-model="form.description" :disabled="false" />
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
              <el-form-item>
                <el-button type="primary" @click="onSubmit">Cập nhật</el-button>
                <el-button>Hủy</el-button>
              </el-form-item>
            </el-form>
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
  name: 'NhaTro',
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
      }
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
.app-container {
  margin: 80px auto;
  max-width: 80% !important;
}
</style>
