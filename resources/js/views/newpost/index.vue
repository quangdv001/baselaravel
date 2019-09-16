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
              <span>PHÒNG TRỌ - ĐĂNG BÀI</span>
            </div>

            <el-form ref="form" :model="form" label-width="120px">
              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="TIÊU ĐỀ * :">
                    <input type="text" v-model="form.description" :disabled="false"/>
                  </el-form-item>
                </el-col>

                <el-col :span="12">
                  <el-form-item label="ĐỊA CHỈ * :">
                    <input type="text" v-model="form.add" :disabled="false"/>
                  </el-form-item>
                </el-col>
              </el-row>

              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="DIỆN TÍCH * :">
                    <input type="text" v-model="form.dientich" :disabled="false"/>
                  </el-form-item>
                </el-col>

                <el-col :span="12">
                  <el-form-item label="DIỆN TÍCH * :">
                    <input type="text" v-model="form.dientich" :disabled="false"/>
                  </el-form-item>
                </el-col>
              </el-row>
              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="GIÁ * :">
                    <input type="text" v-model="form.dientich" :disabled="false"/>
                  </el-form-item>
                </el-col>

                <el-col :span="12">
                  <el-form-item label="LOẠI HÌNH * :">
                    <input type="text" v-model="form.loaihinh" :disabled="false"/>
                  </el-form-item>
                </el-col>
              </el-row>
              <el-row :gutter="20">
                <el-col :span="12">
                  <el-form-item label="MÔ TẢ * :">
                    <el-input
                      type="textarea"
                      :autosize="{ minRows: 2, maxRows: 4}"
                      placeholder="Nhập mô tả"
                      v-model="textareaMota">
                    </el-input>
                  </el-form-item>
                </el-col>
                <el-col :span="12">
                  <el-form-item label="ĐĂNG ẢNH * :">
                    <el-upload max-width="100%" class="upload-demo" drag action="https://jsonplaceholder.typicode.com/posts/" :on-preview="handlePreview" :on-remove="handleRemove" multiple>
                      <i class="el-icon-upload"></i>
                      <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                    </el-upload>
                  </el-form-item>
                </el-col>
              </el-row>

              <el-form-item>
              </el-form-item>

              <el-form-item class="group-button">
                <el-button type="info" icon="el-icon-circle-close" plain>Hủy bỏ</el-button>
                <el-button type="primary" icon="el-icon-check" plain>Đồng ý</el-button>
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
  name: 'Newpost',
  components: {
    UserCard
  },
  data() {
    return {
      loading: false,
      textareaMota: '',
      fileList: [{name: '', url: ''}, {name: '', url: ''}],
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
        money: '1.000.000',
        mota: 'Cho thuê mặt bằng',
        loaihinh: 'Trả trước 30%'
      }
    }
  },
  computed: {
    ...mapGetters([
      'avatar'
    ])
  },
  methods: {
    handleRemove(file, fileList) {
      console.log(file, fileList)
    },
    handlePreview(file) {
      console.log(file)
    }
  }
}
</script>

<style lang="scss" scoped>
.app-container {
  margin: 80px auto;
  max-width: 80% !important;
}

input[type=text] {
  border: none;
  border-bottom: 1px solid #dcdfe6;
  outline: none;
}

.group-button {
  display: flex;
  justify-content: flex-end;
}
</style>
