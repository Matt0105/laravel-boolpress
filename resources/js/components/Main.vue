<template>
  <div>
      <div class="container">
          <div class="post-card" v-for="post in posts" :key="post.id">
              <div class="head-title">
                  <h1>{{post.title}}</h1>
                  <span class="category">Category: {{getCategory(post.category_id)}}</span>
              </div>
              <div class="paragraph-container">
                  <p>{{post.content}}</p>
              </div>
              <div class="tags">
                  <span class="badge" v-for="tag in getTags(post)" :key="tag.id">{{tag}}</span>
              </div>
              <span class="author">Author: {{getUser(post.user_id)}}</span>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: "Main",
    data() {
        return {
            posts: [],
            users: [],
            categories: [],
            tags: [],
        }
    },
    created() {
        axios.get("http://127.0.0.1:8000/api/posts")
            .then(res => {
                console.log(res);
                this.posts = res.data.resultsPosts.data;
                this.users = res.data.resultsUsers;
                this.categories = res.data.resultsCategories;
                this.tags = res.data.resultsTags;
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        getUser(postUserId) {
            let user;
            this.users.map(el => {
                if(el.id === postUserId) {
                    user = el.name;
                }
            })

            return user;
       
        },
        getCategory(postCategoryId) {
            let category;
            this.categories.map(el => {
                if(el.id === postCategoryId) {
                    category = el.name;
                }
            })

            return category;
        },
        getTags(post) {
            let postTags = [];

            // postTags = this.tags.filter(el => {
            //     if(el.id == post.id) {
            //         return el.tags;
            //     }
            // });

            // return postTags;

            for(let i = 0; i < this.tags.length; i++) {
                for(let y = 0; y < this.tags[i].posts.length; y++) {
                    if(this.tags[i].posts[y].id == post.id) {
                        postTags.push(this.tags[i].name);
                        y = this.tags[i].posts.length;
                    }
                }
            }
            return postTags;

        }
    }
}
</script>

<style lang="scss" scoped>

    .post-card {
        position: relative;
        width: 60%;
        height: 400px;
        border: 1px solid black;
        border-radius: 10px;
        margin: 1rem auto;
        overflow: hidden;

        .head-title {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 80px;
            background-color: rgb(37, 162, 235);
            color: white;
        }

        .paragraph-container {
            overflow: scroll;
            p {
                padding: 1rem;
                max-height: 250px;
            }
        }

        .author {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-style: oblique;
        }

        .tags {
            position: absolute;
            bottom: 10px;
            left: 10px;

            .badge {
                color: white;
                padding: 0.4rem 0.7rem;
                background-color: rgb(37, 162, 235);
                border-radius: 20px;
                margin: 0 0.2rem
            }
        }
    }
</style>