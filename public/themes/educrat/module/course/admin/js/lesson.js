window.courseLessonsManagement = new Vue({
    el:'#lessons_management',
    data:{
        onEdit:false,
        options:{},
        sections:course_sections_data.sections,
        lecture_form:{
            type:'',
            id:'',
            name:'',
            duration:'',
            url:'',
            preview_url:'',
            file_id:'',
            active:1,
            display_order:0
        },
        section_form:{
            id:'',
            title:'',
            active:1,
            display_order:0
        },
        i18n:course_sections_data.i18n,
        error:[],
        routes:course_sections_data.routes,
        onSaving:false,
        lastSection:false,
        course_id:course_sections_data.id,
        lastEditObject:{}
    },
    mounted:function () {
    },
    computed:{
        fileIdType:function () {
            switch (this.lecture_form.type) {
                default:
                    return this.lecture_form.type;
                    break;
            }
        },
        add_lecture_title:function () {
            return this.i18n.add_lesson[this.lecture_form.type]
        },
    },
    methods:{
        addLesson:function (type,section) {
            this.lecture_form = {
                type:type,
                id:'',
                name:'',
                duration:'',
                url:'',
                preview_url:'',
                file_id:'',
                active:1,
                display_order:0
            };
            this.lastSection = section;
            this.error = [];
            switch (type) {
                default:
                    $('#add_lecture_modal').modal('show');
                    break;
            }

        },
        editLesson:function (row,section) {
            this.lastSection = section;
            this.lecture_form = Object.assign({},row);
            this.lastEditObject = row;
            this.error = [];

            $('#add_lecture_modal').modal('show');

        },
        openSectionForm:function (e,section) {
            this.error = [];
            if(section){
                this.section_form = Object.assign({},section);
                this.lastSection = section;
            }else{
                this.section_form = {
                    id:'',
                    title:'',
                    active:1,
                    display_order:0
                };
            }
            $('#add_section_modal').modal('show');

        },
        deleteLesson:function(lesson,section_index,lesson_index){
            var c = confirm(this.i18n.delete_lesson);
            if(!c) return;
            var me = this;

            $.ajax({
                url:this.routes.delete,
                data:{
                    section_id:section.id,
                    lesson_id:lesson.id
                },
                dataType:'json',
                type:'post',
                success:function (json) {
                    me.onSaving = false;
                    if(json.message && !json.status){
                        BCApp.showAjaxMessage(json);
                    }

                    if(json.status){
                        me.sections[section_index].lessons.splice(lesson_index,1)
                    }

                },
                error:function (e) {
                    me.onSaving = false;
                    BCApp.showAjaxError(e);
                }
            })

        },
        saveLesson:function () {
            var me = this;
            if(me.onSaving) return;

            if(!this.validateLecture()){
                return false;
            }

            me.onSaving = true;

            var data = Object.assign({},this.lecture_form);
            data.section_id = me.lastSection ? me.lastSection.id : '';
            data.course_id = me.course_id;
            if(!data.type) data.type = 'video';
            $.ajax({
                url:this.routes.store,
                data:data,
                dataType:'json',
                type:'post',
                success:function (json) {
                    me.onSaving = false;
                    if(json.message && !json.status){
                        BCApp.showAjaxMessage(json);
                    }

                    if(json.status){
                        me.updateLectureData(data.section_id,json.lecture.id,json.lecture);
                        $('#add_lecture_modal').modal('hide');
                    }

                },
                error:function (e) {
                    me.onSaving = false;
                    BCApp.showAjaxError(e);
                }
            })
        },
        updateLectureData:function(section_id,lecture_id,data){
            var sectionIndex  = _.findIndex(this.sections,{id:section_id});
            if(sectionIndex > -1){
                var lectureIndex = _.findIndex(this.sections[sectionIndex].lessons,{id:lecture_id});
                console.log(sectionIndex,lectureIndex)
                if(lectureIndex > -1 ){
                    //this.sections[sectionIndex].modules[lectureIndex] = data;
                    for(var k in data){
                        this.$set(this.sections[sectionIndex].lessons[lectureIndex],k,data[k]);
                    }
                    return;
                }
            }
            this.sections[sectionIndex].lessons.push(data)
        },
        validateLecture:function () {
            this.error = [];
            var error = [];
            if(!this.lecture_form.name){
                error.push(this.i18n.validate.title);
            }
            // if(this.lecture_form.type == 'iframe'){
            //     if(!this.lecture_form.url){
            //         error.push(this.i18n.validate.url);
            //     }
            // }else{
            //     if(!this.lecture_form.file_id){
            //         error.push(this.i18n.validate.file_id);
            //     }
            // }
            if(!this.lecture_form.duration){
                error.push(this.i18n.validate.duration);
            }
            this.error = error;
            if(error.length) return false;

            return true;
        },
        saveSection:function () {
            var me = this;
            if(me.onSaving) return;

            if(!this.validateSection()){
                return false;
            }

            me.onSaving = true;

            var data = Object.assign({},this.section_form);
            data.course_id = me.course_id;
            $.ajax({
                url:this.routes.store_section,
                data:data,
                dataType:'json',
                type:'post',
                success:function (json) {
                    me.onSaving = false;
                    if(json.message && !json.status){
                        BCApp.showAjaxMessage(json);
                    }

                    if(json.section){
                        me.sections.push(json.section);
                    }else{
                        for(var k in data){
                            me.$set(me.lastSection,k,data[k]);
                        }
                    }

                    if(json.status){
                        $('#add_section_modal').modal('hide');
                    }
                },
                error:function (e) {
                    me.onSaving = false;
                    BCApp.showAjaxError(e);
                }
            })
        },
        validateSection:function () {
            this.error = [];
            var error = [];
            if(!this.section_form.name){
                error.push(this.i18n.validate.section_title);
            }
            this.error = error;
            if(error.length) return false;
            return true;
        },

        deleteSection:function(section,index){
            var c = confirm(this.i18n.delete_section);
            if(!c) return;
            var me = this;

            $.ajax({
                url:this.routes.delete_section,
                data:{
                    section_id:section.id,
                },
                dataType:'json',
                type:'post',
                success:function (json) {
                    me.onSaving = false;
                    if(json.message && !json.status){
                        BCApp.showAjaxMessage(json);
                    }

                    if(json.status){
                        me.sections.splice(index,1)
                    }

                },
                error:function (e) {
                    me.onSaving = false;
                    BCApp.showAjaxError(e);
                }
            })

        },
    },
});
