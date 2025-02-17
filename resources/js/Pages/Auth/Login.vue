<script setup>
import { ref } from "vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

// Toggle password visibility
const showPassword = ref(false);
const togglePassword = () => {
  showPassword.value = !showPassword.value;
};
</script>

<style scoped>
* {
  font-family: "Poppins", sans-serif;
}
.main-container {
  position: absolute;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}
.main-container .form {
  position: relative;
  width: 35%;
  height: auto;
}
.google {
  position: relative;
  width: 10%;
  height: 10%;
  border-radius: 50%;
}
.go-back {
  position: absolute;
  bottom: 3%;
  left: 3%;
}
.password-wrapper {
  position: relative;
}
.eye-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateX(-10%);
  cursor: pointer;
}
</style>

<template>
  <div
    class="main-container bg-light d-flex flex-row justify-content-center align-items-center"
  >
    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="form">
      <h3 class="text-dark text-center fw-semibold">Login</h3>

      <div>
        <InputLabel for="email" value="Email address" />
        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
          style="border-radius: 10px"
          placeholder="you@example.com"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4 password-wrapper">
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          :type="showPassword ? 'text' : 'password'"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
          style="border-radius: 10px"
          placeholder="8 letters and long"
        />
        <i
          :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"
          class="eye-icon"
          @click="togglePassword"
        ></i>
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4 d-flex flex-column">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Forgot your password?
        </Link>

        <PrimaryButton
          class="w-100 d-block mt-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          style="border-radius: 10px"
        >
          Log in
        </PrimaryButton>

        <p class="text-dark fw-light mt-3 text-center">
          Didn't have an account? |
          <Link :href="route('register')"> Signup </Link>
        </p>
      </div>
    </form>
  </div>
</template>
