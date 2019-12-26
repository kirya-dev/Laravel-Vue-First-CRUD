<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'indexBook'}" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{isEditing ? 'Update' : 'Edit'}} entry</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Name</label>
                            <input type="text" v-model="entry.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Production Year</label>
                            <input type="text" v-model="entry.production_year" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Price</label>
                            <input type="text" v-model="entry.price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Description</label>
                            <textarea v-model="entry.description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Authors</label>

                            <div class="form-inline" v-for="author, idx in entry.authors" style="padding-bottom: 7px">
                                <select v-model="author.pivot.author_id" class="form-control">
                                    <option disabled>Choose...</option>
                                    <option v-for="oneAuthor in allAuthors" :value="oneAuthor.id">{{ oneAuthor.first_name }} {{ oneAuthor.last_name }}</option>
                                </select>
                                <select v-model="author.pivot.author_type_id" class="form-control">
                                    <option disabled>Choose...</option>
                                    <option v-for="authorType in allAuthorTypes" :value="authorType.id">{{ authorType.name }}</option>
                                </select>
                                <button class="btn btn-danger" @click.prevent="entry.authors.splice(idx, 1)">Remove</button>
                            </div>

                            <button class="btn btn-primary" @click.prevent="entry.authors.push({pivot: {}})">Add</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">{{ isEditing ? 'Update' : 'Store'}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/v1/authors')
                .then(resp => {
                    this.allAuthors = resp.data;
                })
                .catch(resp => {
                    alert("Could not load")
                });

            axios.get('/api/v1/author-types')
                .then(resp => {
                    this.allAuthorTypes = resp.data;
                })
                .catch(resp => {
                    alert("Could not load")
                });

            if (this.isEditing) {
                this.entryId = this.$route.params.id;

                axios.get('/api/v1/books/' + this.entryId)
                    .then(resp => {
                        this.entry = resp.data;
                    })
                    .catch(resp => {
                        alert("Could not load")
                    });
            }
        },
        data: function () {
            return {
                entryId: null,
                entry: {
                    name: '',
                    production_year: '',
                    price: '',
                    description: '',
                    authors: [],
                },
                allAuthors: [],
                allAuthorTypes: []
            }
        },
        methods: {
            saveForm() {
                this.doSave()
                    .then(resp => {
                        this.$router.replace({name: 'indexBook'});
                    })
                    .catch(resp => {
                        console.log(resp);
                        alert("Could not create");
                    });
            },
            doSave() {
                return this.isEditing
                    ? axios.patch('/api/v1/books/' + this.entryId, this.entry)
                    : axios.post('/api/v1/books', this.entry)
            },
        },
        computed: {
            isEditing() {
                return this.$route.name === 'editBook';
            },
        },
    }
</script>