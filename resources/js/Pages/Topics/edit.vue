<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    topic: Object,
    file: String,
});

//console.log(props.topic);
const form = useForm({
    name: props.topic.name,
    file: null,
});

function update() {
    //console.log(form.name);
    //form.put(`/topics/${props.topic.id}`);
    Inertia.post(`/topics/${props.topic.id}`, {
        _method: "put",
        name: form.name,
        file: form.file,
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="row col-m-2">
                <h2
                    class="col font-semibold text-xl text-gray-800 leading-tight"
                >
                    Create Topic
                </h2>
                <Link href="/topics" class="col btn btn-primary">Back</Link>
            </div>
        </template>
        <div class="container-fluid p-2 m-auto">
            <div class="d-flex card">
                <form @submit.prevent="update">
                    <h1 class="card-header">Upload</h1>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="input">Nombre</label>
                            <input
                                type="text"
                                name="name"
                                v-model="form.name"
                            />
                        </div>
                        <img :src="props.file" alt="" />
                        <div class="form-group">
                            <label for="file">
                                <input
                                    type="file"
                                    @input="form.file = $event.target.files[0]"
                                />
                            </label>
                        </div>
                    </div>
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
