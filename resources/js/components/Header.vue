<template>
  <nav>
      <div class="container">
        <div class="logo-container">
            <img class="logo-img" :src="logo" alt="">
        </div>
        <ul class="link-list">
            <li v-for="link in linkList" :key="link.id"><router-link :to="{name: link.routeLink}">{{link.label}}</router-link></li>
        </ul>
        
      </div>
  </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            logo: require("../../img/logo.png"),
            linkList: [
                {
                    id: 1,
                    label: "Home",
                    routeLink: "home"
                },
                {
                    id: 2,
                    label: "Posts",
                    routeLink: "posts"
                },
                {
                    id: 3,
                    label: "About",
                    routeLink: "about"
                },
                {
                    id: 4,
                    label: "Contacts",
                    routeLink: "contacts"
                },
            ]
        }
    }
}
</script>

<style lang="scss" scoped>

    nav {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 100%;
        height: 70px;
        background-color: rgba(42, 167, 240, 0.603);

        .logo-img {
            height: 60px;
        }

        .container {
            display: flex;
            align-items: center;


            .link-list {
                display: flex;
                list-style-type: none;
                margin: 0 auto;

                li {
                    padding: 0.5rem;

                    a {
                        color: black;
                        text-decoration: none;
                    }
                }
            }
        }
    }

</style>