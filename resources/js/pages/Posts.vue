<template>
  <div>
      <div class="filter-container">
          <form action="">
            <select name="orderCol" id="orderCol" v-model="search.orderCol">
                <option value="title">Title</option>
                <option value="category">Category</option>
                <option value="created_at">Creation</option>
                <option value="updated_at">Update</option>
            </select>
            
            <select name="orderVs" id="orderVs" v-model="search.orderVs">
                <option value="desc">Desc</option>
                <option value="asc">Asc</option>
            </select>

            <div class="check-container" v-for="(tag, index) in postInfo.tags" :key="tag.name + index">
                <input type="checkbox" name="tags[]" :value="tag.name" v-model="search.tags">
                <label :for="tag.name">{{tag.name}}</label>
            </div>
            <input class="btn btn-success" type="submit" @click.prevent="searchPosts()">
          </form>
      </div>
      <Main :postInfo="postInfo" :pageTitle="`All Posts`"/>
  </div>
</template>

<script>

import Main from "../components/Main.vue";

export default {
    name: "Posts",
    components: {
        Main,
    },
    data() {
        return {
            
            search: {
                orderVs: "asc",
                orderCol: "updated_at",
                tags: [],
            },
            postInfo: {
                
                posts: [],
                users: [],
                categories: [],
                tags: [],
                nextPage: "",
                prevPage: ""
                
            }
            // posts: []
        }
    },
    created() {
        //faccio la chiamata all'api e popolo tutte le info, con anche user, category, tags e pagine prev e next
        axios.get("http://127.0.0.1:8000/api/posts/allPosts")
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        searchPosts() {
            axios.get("http://127.0.0.1:8000/api/posts/search", {params: this.search})
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
}
</script>

<style>

</style>