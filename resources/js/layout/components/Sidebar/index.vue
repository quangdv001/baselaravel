<template>
  <el-scrollbar wrap-class="scrollbar-wrapper">
    <el-menu
      :show-timeout="200"
      :default-active="$route.path"
      :collapse="isCollapse"
      mode="vertical"
      background-color="#304156"
      text-color="#bfcbd9"
      active-text-color="#409EFF"
    >
      <div class="header_logo" style="display:block; background:#fff;">
        <img height="50px" src="http://chkvietnam.vn/assets/images/logo.png" alt="chk">
      </div>
      <sidebar-item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" />
    </el-menu>
  </el-scrollbar>
</template>

<script>
import { mapGetters } from 'vuex';
import SidebarItem from './SidebarItem';

export default {
  components: { SidebarItem },
  computed: {
    ...mapGetters([
      'sidebar',
      'permission_routers',
    ]),
    routes() {
      return this.$store.state.permission.routes;
    },
    isCollapse() {
      return !this.sidebar.opened;
    },
  },
};
</script>
