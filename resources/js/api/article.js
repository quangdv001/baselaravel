import request from '@/utils/request';

export function fetchList(current_page = 1, limit = 10, name = null) {
  const queries = 'page=' + current_page +  '&limit=' + limit +  '&name=' + name
  return request({
    url: `/my/article/search?${queries}`,
    method: 'get'
  })
}
export function show(id) {
  return request({
    url: `/my/article/show` + id,
    method: 'get',
    // params: query,
  })
}
export function create(data) {
  if (data)
  return request({
    url: `/my/article/create`,
    method: 'post',
    data:  data 
  })
}
export function edit(data) {
  if (data && data.id) {
    return request({
      url: `/my/article/update/` + data.id,
      method: 'post',
      data:  data 
    })
  }
}

export function remove(id) {
  if (id) {
    return request({
      url: `/my/article/remove`,
      method: 'post',
      data:  { id: id }
    })
  }
}

// export function fetchList(query) {
//   return request({
//     url: '/articles',
//     method: 'get',
//     params: query,
//   });
// }

// export function fetchArticle(id) {
//   return request({
//     url: '/articles/' + id,
//     method: 'get',
//   });
// }

// export function fetchPv(id) {
//   return request({
//     url: '/articles/' + id + '/pageviews',
//     method: 'get',
//   });
// }

// export function createArticle(data) {
//   return request({
//     url: '/article/create',
//     method: 'post',
//     data,
//   });
// }

// export function updateArticle(data) {
//   return request({
//     url: '/article/update',
//     method: 'post',
//     data,
//   });
// }

export function upload(data) {
  return request({
    url: '/my/article/uploadImage',
    method: 'post',
    data: data
  });
}