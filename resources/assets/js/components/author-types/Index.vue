<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createAuthorType'}" class="btn btn-success">Create new entry</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Entries list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="entry, index in entries">
                        <td>{{ entry.id }}</td>
                        <td>{{ entry.name }}</td>
                        <td>
                            <router-link :to="{name: 'editAuthorType', params: {id: entry.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click.prevent="deleteEntry(entry.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                entries: []
            }
        },
        mounted() {
            axios.get('/api/v1/author-types')
                .then(resp => {
                    this.entries = resp.data;
                })
                .catch(resp => {
                    console.log(resp);
                    alert("Could not load entries");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    axios.delete('/api/v1/author-types/' + id)
                        .then(resp => {
                            this.entries.splice(Index, 1);
                        })
                        .catch(resp => {
                            alert("Could not delete entry");
                        });
                }
            }
        }
    }
</script>