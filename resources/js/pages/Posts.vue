<template>
  <div>
      <div class="filter-container">
          <form action="">
            <select name="orderCol" id="orderCol" v-model="orderCol">
                <option value="title">Title</option>
                <option value="category">Category</option>
                <option value="created_at">Creation</option>
                <option value="updated_at">Update</option>
            </select>
            
            <select name="orderVs" id="orderVs" v-model="orderVs">
                <option value="desc">Desc</option>
                <option value="asc">Asc</option>
            </select>
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
            orderVs: "asc",
            orderCol: "updated_at",
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
            axios.get("http://127.0.0.1:8000/api/posts/search", {params: {orderCol: this.orderCol, orderVs: this.orderVs}})
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