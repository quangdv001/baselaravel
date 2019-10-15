import request from '@/utils/request';

export function fetchList(current_page = 1, limit = 10) {
  const queries = 'page=' + current_page +  '&limit=' + limit
  return request({
    url: `/my/rent/search?${queries}`,
    method: 'get'
  })
}
export function show(id) {
  return request({
    url: `/my/rent/show` + id,
    method: 'get',
    // params: query,
  })
}
export function create(data) {
  if (data)
  return request({
    url: `/my/rent/create`,
    method: 'post',
    data:  data // { name, address, description  }
  })
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/rent/update/` + data.id,
      method: 'post',
      data:  data // { name, address, description  }
    })
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/rent/remove`,
      method: 'post',
      data:  { id: id }
    })
  }
}
