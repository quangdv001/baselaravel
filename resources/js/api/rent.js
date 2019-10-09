import request from '@/utils/request';

export function fetchList(query, current_page = 1) {
  return request({
    url: `/my/rent/search?page=${current_page}`,
    method: 'get',
    params: query,
  });
}
export function show(id) {
  return request({
    url: `/my/rent/show` + id,
    method: 'get',
    // params: query,
  });
}
export function create(data) {
  if (data)
  return request({
    url: `/my/rent/create`,
    method: 'post',
    data:  data // { name, address, description  }
  });
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/rent/update/` + data.id,
      method: 'post',
      data:  data // { name, address, description  }
    });
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/rent/remove`,
      method: 'post',
      data:  { id: id }
    });
  }
}
