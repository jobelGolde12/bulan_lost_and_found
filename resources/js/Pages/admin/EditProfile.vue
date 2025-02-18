<script setup>
import { useForm, Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UploadImage from "@/Components/UploadImage.vue";
import { defineProps } from "vue";

const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
  userInfo: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({
  profile_pic: null,
  address: props.userInfo?.address || "",
  bio: props.userInfo?.bio || "",
  contact: props.userInfo?.contact || "",
  facebook_link: props.userInfo?.facebook_link || "",
});

const handleFileChange = (event) => {
  form.profile_pic = event.target.files[0] || null;
};

const submit = () => {
  const formData = new FormData();
  Object.keys(form.data()).forEach((key) => {
    if (key === "profile_pic" && form.profile_pic) {
      formData.append(key, form.profile_pic);
    } else {
      formData.append(key, form[key]);
    }
  });

  form.transform(() => formData).put(route("user.update", props.user.id), {
    forceFormData: true,
    onSuccess: () => console.log("Profile updated successfully!"),
    onError: (errors) => console.error("An error occurred:", errors),
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Edit profile" />
    <div class="container container-top">
      <div>
        <h1 class="text-center fw-lighter">
          Edit Profile
        </h1>
      </div>
      <form
        @submit.prevent="submit"
        class="form mx-auto bg-white p-6 rounded-lg shadow-md w-full max-w-2xl"
        enctype="multipart/form-data"
      >
        <UploadImage />

        <div class="mb-4">
          <label for="bio" class="block text-lg font-medium text-gray-700">Bio</label>
          <textarea
            v-model="form.bio"
            id="bio"
            class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
            placeholder="Tell something about yourself"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
          <input
            v-model="form.address"
            id="address"
            class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
            placeholder="ex: Bonga, Bulan, Sorsogon"
          />
        </div>

        <div class="mb-4">
          <label for="contact" class="block text-lg font-medium text-gray-700">Contact</label>
          <input
            v-model="form.contact"
            id="contact"
            type="text"
            class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
            placeholder="ex: 09460163977"
          />
        </div>

        <div class="mb-4">
          <label for="facebook_link" class="block text-lg font-medium text-gray-700">Social Links (optional)</label>
          <input
            type="text"
            v-model="form.facebook_link"
            id="facebook_link"
            class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
            placeholder="facebook/twitter/instagram/etc."
          />
        </div>

        <button type="submit" class="btn btn-dark w-100">Save Changes</button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.container-top {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  padding-top: 20rem;
  overflow-y: scroll;
  overflow-x: hidden;
}

.form input,
.form textarea {
  border: 1px solid rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease-in-out;
}

.form input:focus,
.form textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
}
</style>
