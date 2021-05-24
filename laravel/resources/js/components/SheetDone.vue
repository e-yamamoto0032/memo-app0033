<template>
    <div class="card mb-3" style="width: 21rem;">
        <div class="card-body d-flex flex-row">
            <div>
                <h6 class="card-title">{{ title }}</h6>
                <p class="card-text">{{ body }}</p>
                <p class="card-text">完了日　{{ end_date }}</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-danger btn-sm" @click="reverseSheet">戻す</button>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {

    props: {
        title: {
            type: String,
            required: true
        },
        body: {
            type: String,
            required: true
        },
        deadline: {
            type: String,
        },
        end_date: {
            type: String,
        },
        status: {
            type: Number,
            required: true
        },
        user_id: {
            type: Number,
            required: true
        },
        sheetIndex: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        }

    },
    methods: {
        reverseSheet() {
            axios.put('/api/sheets/' + this.id, {
                status: this.reverseStatus,
                id: this.id,
                end_date: moment(),
                deadline: moment(this.deadline, "YYYY年MM月DD日").format("YYYY-MM-DD"),
                title: this.title,
                body: this.body,
                user_id: this.user_id
            })
            location.reload()

        }
    },
    data() {
        return {
            reverseStatus: 0
        }
    },

}

</script>

