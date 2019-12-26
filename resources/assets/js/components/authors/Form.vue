<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'indexAuthor'}" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{isEditing ? 'Update' : 'Edit'}} entry</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">First Name</label>
                            <input type="text" v-model="entry.first_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Last Name</label>
                            <input type="text" v-model="entry.last_name" class="form-control">
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
            if (this.isEditing) {
                this.entryId = this.$route.params.id;

                axios.get('/api/v1/authors/' + this.entryId)
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
                    first_name: '',
                    last_name: '',
                }
            }
        },
        methods: {
            saveForm() {
                this.doSave()
                    .then(resp => {
                        this.$router.replace({name: 'indexAuthor'});
                    })
                    .catch(resp => {
                        console.log(resp);
                        alert("Could not create");
                    });
            },
            doSave() {
                return this.isEditing
                    ? axios.patch('/api/v1/authors/' + this.entryId, this.entry)
                    : axios.post('/api/v1/authors', this.entry)
            },
        },
        computed: {
            isEditing() {
                return this.$route.name === 'editAuthor';
            },
        },
    }
</script>