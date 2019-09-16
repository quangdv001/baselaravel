<template>
  <div :class="classObj" class="app-wrapper">
    <div v-if="device==='mobile'&&sidebar.opened" class="drawer-bg" @click="handleClickOutside" />
    <sidebar class="sidebar-container" />
    <div :class="{hasTagsView:needTagsView}" class="main-container">
      <div :class="{'fixed-header':fixedHeader}">
        <navbar />
        <tags-view v-if="needTagsView" />
      </div>
      <!-- Start menu main -->
      <div class="main-menu-header">
        <div class="content-wrapper">
          <!-- <hamburger id="hamburger-container" :is-active="sidebar.opened" class="menu-item-hamburger hamburger-container" @toggleClick="toggleSideBar" /> -->
          <a v-for="menu in menuMain" :key="menu.name" class="menu-item" :class="{active: $route.path.indexOf(menu.path) === 0}">
            <router-link :to="menu.path"><svg-icon style="margin-right: 10px;" :icon-class="menu.icon"/>{{ menu.name }}</router-link>
          </a>
        </div>
      </div>
      <!-- end menu main -->
      <app-main />
      <right-panel v-if="showSettings">
        <settings />
      </right-panel>
    </div>
  </div>
</template>

<script>
import RightPanel from '@/components/RightPanel';
import { Navbar, Sidebar, AppMain, TagsView, Settings } from './components';
import ResizeMixin from './mixin/resize-handler.js';
import { mapState } from 'vuex';

export default {
  name: 'Layout',
  components: {
    AppMain,
    Navbar,
    RightPanel,
    Settings,
    Sidebar,
    TagsView,
  },
  mixins: [ResizeMixin],
  computed: {
    ...mapState({
      sidebar: state => state.app.sidebar,
      device: state => state.app.device,
      showSettings: state => state.settings.showSettings,
      needTagsView: state => state.settings.tagsView,
      fixedHeader: state => state.settings.fixedHeader,
    }),
    classObj() {
      return {
        hideSidebar: !this.sidebar.opened,
        openSidebar: this.sidebar.opened,
        withoutAnimation: this.sidebar.withoutAnimation,
        mobile: this.device === 'mobile',
      };
    },
  },
  data() {
    return {
      menuMain: [
        {
          icon: 'chart',
          path: '/nha-tro/index',
          name: 'Nhà trọ'
        },
        {
          icon: 'people',
          path: '/phong-tro/index',
          name: 'Phòng trọ'
        },
        {
          icon: 'shopping',
          path: '/dich-vu/index',
          name: 'Dịch vụ'
        },
        {
          icon: 'excel',
          path: '/hop-dong/index',
          name: 'Hợp đồng'
        },
        {
          icon: 'table',
          path: '/hoa-don/index',
          name: 'Hóa đơn'
        },
        {
          icon: 'peoples',
          path: '/user/index',
          name: 'Khách hàng'
        },
        {
          icon: 'guide',
          path: '/newpost/index',
          name: 'Bài đăng'
        }
      ]
    }
  },
  methods: {
    handleClickOutside() {
      this.$store.dispatch('app/closeSideBar', { withoutAnimation: false });
    },
  },
};
</script>

<style lang="scss" scoped>
  @import "~@/styles/mixin.scss";
  @import "~@/styles/variables.scss";

  .app-wrapper {
    @include clearfix;
    position: relative;
    height: 100%;
    width: 100%;

    &.mobile.openSidebar {
      position: fixed;
      top: 0;
    }
    .main-container { padding-top: 50px;}
  }

  .drawer-bg {
    background: #000;
    opacity: 0.3;
    width: 100%;
    top: 0;
    height: 100%;
    position: absolute;
    z-index: 999;
  }

  .fixed-header {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9;
    width: calc(100% - #{$sideBarWidth});
    transition: width 0.28s;
  }

  .hideSidebar .fixed-header {
    width: calc(100% - 54px)
  }

  .mobile .fixed-header {
    width: 100%;
  }
</style>
