<template>
    <div class="user-dashboard">
        <div class="list-user-comp">
            <h4>List User</h4>
            <ListUser @userSelected="childrenSelectUser('abc', ...arguments)"></ListUser>
        </div>
        <hr>
        <div class="user-detail-comp">
            <h4>User Detail</h4>
            <UserDetail :userDetailInfo="userSelectedFromChild"></UserDetail>
        </div>
    </div>
</template>

<script>
import ListUser from "./ListUser";
import UserDetail from "./UserDetail";
export default {
    name: "UserDashboard",
    components: {UserDetail, ListUser},
    data(){
        return {
            userSelectedFromChild : {}
        }
    },
    methods: {
        // Process event emitted from child
        childrenSelectUser(text,user, number, string) {
            console.log(text + string + number)
            this.userSelectedFromChild = user;
        }
    }
}
</script>

<style scoped>

</style>
