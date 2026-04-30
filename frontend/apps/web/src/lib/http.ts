import { ofetch } from 'ofetch'

export const http = ofetch.create({
  baseURL: import.meta.env.VITE_API_URL,
})
