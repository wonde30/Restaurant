<script setup lang="ts">

import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
const router = useRouter();
const auth = useAuthStore();
const email = ref("");
const password = ref("");
const loading = ref(false);
const errors = ref({
  email: "",
  password: "",
  general: "",
});
const validateForm = (): boolean => {
  errors.value = {
    email: "",
    password: "",
    general: "",
  };
  let isValid = true;
  if (!email.value.trim()) {
    errors.value.email = "Email is required";
    isValid = false;
  }
  if (!password.value.trim()) {
    errors.value.password = "Password is required";
    isValid = false;
  }
  return isValid;
};
const login = async (): Promise<void> => {
  if (!validateForm()) return;
  loading.value = true;
  try {
    await auth.login(
      email.value,
      password.value
    );

    const role = auth.user?.role;
    switch (role) {
      case "admin":
        router.push("/admin");
        break;

      case "receptionist":
        router.push("/receptionist");
        break;
      case "cashier":
        router.push("/cashier");
        break;
      case "chef":
        router.push("/chef");
        break;
      case "manager":
        router.push("/manager");
        break;
      default:
        router.push("/");
    }
  } catch (error: any) {
    errors.value.general =
      error?.response?.data?.message ||
      "Invalid email or password";
  } finally {
    loading.value = false;
  }
};
</script>
<template>
  <div
    class="
      min-h-screen
      flex
      items-center
      justify-center
      bg-slate-100
      px-4
    "
  >
    <div
      class="
        w-full
        max-w-md
        bg-white
        rounded-2xl
        shadow-xl
        p-8
      "
    >
      <div class="text-center mb-8">
        <h1
          class="
            text-3xl
            font-bold
            text-slate-800
          "
        >
          Hotel Management System
        </h1>

        <p
          class="
            text-slate-500
            mt-2
          "
        >
          Sign in to continue
        </p>
      </div>
      <div
        v-if="errors.general"
        class="
          mb-4
          bg-red-100
          border
          border-red-300
          text-red-700
          px-4
          py-3
          rounded-lg
        "
      >
        {{ errors.general }}
      </div>

      <!-- Email -->
      <div class="mb-5">
        <label
          class="
            block
            mb-2
            text-sm
            font-medium
            text-slate-700
          "
        >
          Email Address
        </label>

        <input
          v-model="email"
          type="email"
          placeholder="email"
          class="
            w-full
            px-4
            py-3
            border
            rounded-lg
            focus:outline-none
            focus:ring-2
            focus:ring-blue-500
          "
        />

        <p
          v-if="errors.email"
          class="
            mt-1
            text-sm
            text-red-500
          "
        >
          {{ errors.email }}
        </p>
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label
          class="
            block
            mb-2
            text-sm
            font-medium
            text-slate-700
          "
        >
          Password
        </label>

        <input
          v-model="password"
          type="password"
          placeholder="********"
          class="
            w-full
            px-4
            py-3
            border
            rounded-lg
            focus:outline-none
            focus:ring-2
            focus:ring-blue-500
          "
        />

        <p
          v-if="errors.password"
          class="
            mt-1
            text-sm
            text-red-500
          "
        >
          {{ errors.password }}
        </p>
      </div>

      <!-- Login Button -->
      <button
        @click="login"
        :disabled="loading"
        class="
          w-full
          bg-blue-600
          hover:bg-blue-700
          disabled:bg-gray-400
          text-white
          font-semibold
          py-3
          rounded-lg
          transition
        "
      >
        <span v-if="loading">
          Signing In...
        </span>
        <span v-else>
          Sign In
        </span>
      </button>
    </div>
  </div>
</template>