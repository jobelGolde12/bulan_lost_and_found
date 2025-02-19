<script setup>
import { ref, watch } from "vue";
import { Link, useForm, Head } from "@inertiajs/vue3";
import CustomModal from "@/Components/CustomModal.vue";
const props = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
  created_by: {
    type: Object,
    default: () => ({}),
  },
});

const data = ref({});
const deleteMessage = ref("Are you sure you want to delete this item?");
const response = ref();

watch(
  () => props.item,
  (newItem) => {
    data.value = newItem;
  },
  { immediate: true }
);

const deleteItem = useForm({
  id: data.id,
});

// response hali sa modal kung gusto ni user eh delete an item
const getResponse = (res) => {
  try {
    if (res === "yes") {
      deleteItem.delete(route("deleteItem", { id: props.item?.id }), {
        onSuccess: () => alert("deleted"),
        onError: (errors) => console.log("error => " + errors),
      });
    }
  } catch (err) {
    alert("item cannot be deleted.");
    console.error("an error occured while deleting data => ", err);
  }
};
</script>

<template>
  <Head title="View item info"/>
  <div class="main-container bg-light row">
      <div v-if="Object.keys(data).length > 0" class="left col-12 col-sm-6 col-lg-6">
        <div class="card bg-light">
          <div class="card-body">
            <div class="image-container">
              <img v-if="data.image_url" :src="data.image_url" alt="Item Image" class="rounded"/>
            </div>
            <h1 class="my-2">{{ data?.item_name || "No name provided" }}</h1>
          </div>
        </div>
      </div>
    <div class="right col-12 col-sm-6 col-lg-6">
      <div class="card bg-light">
        <div v-if="Object.keys(data).length > 0">
          <div class="card-body">
            <h1 :class="data.status === 'Lost' ? 'text-danger' : 'text-success'">{{ data.status }}</h1>
            <p><strong>Description:</strong> {{ data.item_description }}</p>
            <p><strong>Location:</strong> {{ data.location }}</p>
            <p v-if="data.category">
              <strong>Category:</strong> {{ data.category.name }}
            </p>
            <p v-if="props.created_by?.name">
              <strong>Created by:</strong> {{ props.created_by.name }}
            </p>
            <p v-if="data.owner_phone_number">
              <strong>Contact:</strong> {{ data.owner_phone_number }}
            </p>
            <p>
              <strong>Created at:</strong>
              {{ new Date(data.created_at).toLocaleString() }}
            </p>

            <div class="container px-0 d-flex flex-row gap-2 mt-2">
              <!-- <Link :href="route('visitUser', {id: data.id})" class="button1 text-decoration-none" v-if="props.created_by.name">
                  <span class="d-block d-lg-none"
                    ><i class="bi bi-eye"></i
                  ></span>
                  <span class="d-none d-lg-inline">Visit {{ props.created_by.name }}</span>
                </Link> -->

              <Link :href="route('dashboard')" class="btn btn-dark">
                <span class="d-block d-lg-none"
                  ><i class="bi bi-arrow-left"></i
                ></span>
                <span class="d-none d-lg-inline">Back</span>
              </Link>
            </div>
          </div>
        </div>
        <div v-else>
          <p>Loading item details...</p>
        </div>
      </div>
      asd
    </div>
  </div>

  <CustomModal :name="deleteMessage" :id="data.id" @response="getResponse" />
</template>

<style scoped>
.main-container {
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}
.image-container{
  overflow: hidden;
  min-width: 150px;
}
.image-container img{
  position: relative;
  width: 100%;
  height: 70%;
  transition: .5s;
}
.image-container img:hover{
  transform: scale(1.1);
}
.card{
  border: none;
}
</style>
