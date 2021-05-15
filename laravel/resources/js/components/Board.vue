<template>
    <div>
        <header>
            {{ username }}さんのシート一覧
        </header>

        <div>
            <p>All: {{ totalSheet }} sheets</p>
            <div class="h5 mb-3">作業中</div>
            <div class="row">
                <div class="btn-group btn-group-sm ml-5">
                    <div class="btn btn-primary" aria-current="page">昇順</div>
                    <div class="btn btn-primary">降順</div>
                </div>
                <div @click="openModal" style="cursor: hand; cursor:pointer;">
                    <i class="far fa-plus-square pt-3 ml-3"></i>
                    シートを追加
                </div>
                <sheet-add @close="closeModal" v-show="showContent"/>
            </div>
            <div v-for="(item, index) in sheets">
                <sheet
                    :sheetId="item.id"
                    :title="item.title"
                    :body="item.body"
                    :deadline="item.deadline"
                    :status="item.status"
                    :end_date="item.end_date"
                    :user_id="item.user_id"
                    :sheetIndex="index"

                />
            </div>
            <hr>
            <div class="h5 mb-3">完了済</div>
            <div class="row">
                <div class="btn-group btn-group-sm ml-5">
                    <div class="btn btn-primary" aria-current="page">昇順</div>
                    <div class="btn btn-primary">降順</div>
                </div>
            </div>
            <div v-for="(item, index) in sheets">
                <sheet-done
                    :sheetId="item.id"
                    :title="item.title"
                    :body="item.body"
                    :end_date="item.end_date"
                    :status="item.status"
                    :user_id="item.user_id"
                    :sheetIndex="index"

                />
            </div>
        </div>
    </div>
</template>

<script>
import SheetAdd from "./SheetAdd";
import SheetDone from "./SheetDone";
import Sheet from "./Sheet";
import moment from "moment";
// import {mapState} from 'vuex'

export default {
    components: {
        Sheet,
        SheetAdd,
        SheetDone
    },
    computed: {
        username() {
            return this.$store.getters['auth/username']
        },
        totalSheet() {
            return this.sheets.length
        },
    },
    data() {
        return {
            sheets: [
                {
                    title: 'タイトル1',
                    body: '内容1',
                    deadline: moment("2020-01-01").format("YYYY年MM月DD日"),
                    status: 0,
                    end_date: moment("2021-01-01").format("YYYY年MM月DD日"),
                    user_id: 1,
                },
                {
                    title: 'タイトル2',
                    body: '内容2',
                    deadline: moment("2020-02-02").format("YYYY年MM月DD日"),
                    status: 0,
                    end_date: moment("2021-02-02").format("YYYY年MM月DD日"),
                    user_id: 1,
                },
                {
                    title: 'タイトル3',
                    body: '内容3',
                    deadline: moment("2020-03-03").format("YYYY年MM月DD日"),
                    status: 0,
                    end_date: moment("2021-03-03").format("YYYY年MM月DD日"),
                    user_id: 1,
                },
                {
                    title: 'タイトル4',
                    body: '内容4',
                    deadline: moment("2020-04-04").format("YYYY年MM月DD日"),
                    status: 1,
                    end_date: moment("2021-04-04").format("YYYY年MM月DD日"),
                    user_id: 1,
                },
                {
                    title: 'タイトル5',
                    body: '内容5',
                    deadline: moment("2020-05-05").format("YYYY年MM月DD日"),
                    status: 0,
                    end_date: moment("2021-05-05").format("YYYY年MM月DD日"),
                    user_id: 2,
                },


            ],
            showContent: false,

        }
    },
    methods: {
        openModal() {
            this.showContent = true
        },
        closeModal() {
            this.showContent = false
        }
    },
}
</script>

<style>

</style>
