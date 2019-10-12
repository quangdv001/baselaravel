import request from '@/utils/request';

export function fetchList(current_page = 1) {
  return request({
    url: `/my/motel/search?page=${current_page}`,
    method: 'get'
  })
}
export function show(id) {
  return request({
    url: `/my/motel/show` + id,
    method: 'get',
    // params: query,
  })
}
export function create(data) {
  if (data)
  return request({
    url: `/my/motel/create`,
    method: 'post',
    data:  data // { name, address, description  }
  })
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/motel/update/` + data.id,
      method: 'post',
      data:  data // { name, address, description  }
    })
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/motel/remove`,
      method: 'post',
      data:  { id: id }
    })
  }
}
