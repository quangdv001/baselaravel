import request from '@/utils/request';

export function fetchList(current_page = 1, limit = 10) {
  const queries = 'page=' + current_page +  '&limit=' + limit
  return request({
    url: `/my/contract/search?${queries}`,
    method: 'get'
  })
}

export function search(current_page = 1, keyword = 10) {
  const queries = 'page=' + current_page +  '&name=' + keyword
  return request({
    url: `/my/contract/search?${queries}`,
    method: 'get'
  })
}
export function show(id) {
  return request({
    url: `/my/contract/show` + id,
    method: 'get',
    // params: query,
  })
}
export function create(data) {
  if (data)
  return request({
    url: `/my/contract/create`,
    method: 'post',
    data:  data // { 'name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id'  }
  })
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/contract/update/` + data.id,
      method: 'post',
      data:  data // { 'name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id'  }
    })
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/contract/remove`,
      method: 'post',
      data:  { id: id }
    })
  }
}
