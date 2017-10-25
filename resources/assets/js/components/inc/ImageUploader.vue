<template>
    <el-upload
            name="tempImage"
            class="image-uploader"
            action="http://laravel.dev/api/temp/image"
            :headers="headers"
            :show-file-list="false"
            :on-success="handleSuccess"
            :before-upload="beforeUpload">
        <img v-if="tempImageUrl" :src="tempImageUrl" class="image-preview">
        <i ref="image-uploader-icon" class="el-icon-plus image-uploader-icon" v-else></i>
        <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2mb</div>
    </el-upload>
</template>
<script>
    export default{
        data(){
            return{
                headers:{
                    'X-CSRF-TOKEN':axios.defaults.headers.common['X-CSRF-TOKEN'],
                    'X-Requested-With':axios.defaults.headers.common['X-Requested-With']
                },
                tempImageUrl: '',
            }
        },
        methods:{

            /**
             * Store temp image so as to display in the preview while storing
             * the location in the form module which will be used to correctly
             * store the image in the appropriate place.
             *
             * @param res - response object from server
             * @param file - file object being uploaded.
             * */
            handleSuccess(res, file) {

                this.stopLoading();

                //emit location on server
                this.$emit('Uploaded',res.info.location);

                //store the temp url
                this.tempImageUrl = URL.createObjectURL(file.raw);

                this.$message.success('Photo uploaded successfully');
            },

            /**
             * Do a check before uploading the file.
             *
             * @param file - file object being uploaded.
             * */
            beforeUpload(file) {
                this.startLoading(this.$refs['image-uploader-icon'].$el);

                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Avatar picture must be JPG or PNG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Avatar picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
            },
        }
    }
</script>
<style>
    .image-uploader .el-upload {
        border: 1px dashed #000000;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        /*margin: 20px;*/
    }
    .image-uploader .el-upload:hover {
        border-color: #20a0ff;
    }
    .image-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 200px;
        height: 200px;
        line-height: 200px;
        text-align: center;
    }
    .image-preview {
        width: 200px;
        height: 200px;
        display: block;
    }
</style>