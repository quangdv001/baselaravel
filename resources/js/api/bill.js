import request from '@/utils/request';

export function fetchList(current_page = 1, limit = 30) {
  const queries = 'page=' + current_page +  '&limit=' + limit
  return request({
    url: `/my/bill/search?${queries}`,
    method: 'get'
  })
}

export function search(current_page = 1, keyword = '') {
  const queries = 'page=' + current_page +  '&name=' + keyword
  return request({
    url: `/my/bill/search?${queries}`,
    method: 'get'
  })
}
export function show(id) {
  return request({
    url: `/my/bill/show` + id,
    method: 'get',
    // params: query,
  })
}
export function create(data) {
  if (data)
  return request({
    url: `/my/bill/create`,
    method: 'post',
    data:  data 
  })
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/bill/update/` + data.id,
      method: 'post',
      data:  data 
    })
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/bill/remove`,
      method: 'post',
      data:  { id: id }
    })
  }
}
