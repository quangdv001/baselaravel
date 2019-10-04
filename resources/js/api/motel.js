import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/my/motel/search',
    method: 'get',
    params: query,
  });
}
export function show(id) {
  return request({
    url: '/my/motel/show' + id,
    method: 'get',
    // params: query,
  });
}
export function create(query) {
  return request({
    url: '/my/motel/create',
    method: 'post',
    params: query,
  });
}