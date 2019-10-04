import request from '@/utils/request';

export function getMe(query = null) {
  return request({
    url: '/my/me',
    method: 'get',
    params: query,
  });
}