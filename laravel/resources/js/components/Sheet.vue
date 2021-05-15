<template>
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-body d-flex flex-row">
                <div>
                    <h6 class="card-title">{{ title }}</h6>
                    <p class="card-text">{{ body }}</p>
                    <p class="card-text">期日　{{ deadline }}</p>
                </div>
                <div class="ml-auto card-text">
                    <div class="dropdown">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-pen mr-1"></i>記事を更新する
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success btn-sm">完了</button>
            </div>
        </div>
    </div>
</template>

<script>


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
            required: true
        },
        end_date: {
            type: String,
            required: true
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

    },


}

</script>

