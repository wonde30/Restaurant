import axios from "axios";
// Create reusable axios instance
const api = axios.create({
  // Laravel Backend URL
  baseURL: "http://127.0.0.1:8000/api",
  headers: {
    "Content-Type": "application/json"
  }
});
// Automatically attach token
api.interceptors.request.use((config) => {
  const token =
    localStorage.getItem("token");
  if (token) {
    config.headers.Authorization =
      `Bearer ${token}`;
  }

  return config;
});

export default api;