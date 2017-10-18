import {TweenMax,TimelineMax} from 'gsap/TweenMax.js';
import Vue from 'vue';

Vue.mixin({
    methods:{
        executeFunctionByName(functionName, context /*, args */) {
            console.log(functionName);
            let args = [].slice.call(arguments).splice(2);
            let namespaces = functionName.split(".");
            let func = namespaces.pop();
            for(let i = 0; i < namespaces.length; i++) {
                context = context[namespaces[i]];
            }
            return context[func].apply(context, args);
        },
        fadeEnter(el, done) {
            TweenMax.fromTo(el, 1, {
                autoAlpha: 0,
                scale: 1.5
            }, {
                autoAlpha: 1,
                scale: 1,
                transformOrigin: '50% 50%',
                ease: Power4.easeOut,
                onComplete: done
            });
        },
        fadeLeave(el, done) {
            TweenMax.fromTo(el, 1, {
                autoAlpha: 1,
                scale: 1
            }, {
                autoAlpha: 0,
                scale: 0.8,
                ease: Power4.easeOut,
                onComplete: done
            });
        },
        slideEnter(el, done) {
            let tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                x: window.innerWidth * 1.5,
                transformOrigin: '50% 50%',
                autoAlpha: 0
            });

            tl.to(el, 0.5, {
                x: 0,
                autoAlpha: 1,
                ease: Power4.easeOut
            });
        },
        slideLeave(el, done) {
            let tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                transformOrigin: '50% 50%',
            });

            tl.to(el, 0.5, {
                x: -(window.innerWidth * 1.5),
                autoAlpha: 0,
                ease: Power4.easeOut
            });
        },
        twoPartSlideLeft(el, done, id){
            let tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                transformOrigin: '50% 50%',
                x: $(el).attr('index') == 2? +(window.innerWidth * 1.5) : 0,
                'z-index': $(el).attr('index') == 2? 10 : 0
            });

            tl.to(el, 0.5, {
                x: $(el).attr('index') == 2? 0 : -(window.innerWidth * 1.5),
                ease: Power4.easeOut
            });
        },
        twoPartSlideRight(el, done, id){
            let tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                transformOrigin: '50% 50%',
                x: $(el).attr('index') == 1? -(window.innerWidth * 1.5) : 0,
            });

            tl.to(el, 0.5, {
                x: $(el).attr('index') == 1? 0 : +(window.innerWidth * 1.5),
                ease: Power4.easeOut
            });
        },
        slideUpEnter(el, done) {
            var tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                y: window.innerWidth * 1.5,
                scale: 0.8,
                transformOrigin: '50% 50%'
            });

            tl.to(el, 0.5, {
                y: 0,
                ease: Power4.easeOut
            });

            tl.to(el, 1, {
                scale: 1,
                ease: Power4.easeOut
            });
        },
        slideUpLeave(el, done) {
            TweenMax.to(el, 1, {
                y: window.innerHeight * -1.5,
                ease: Power4.easeOut,
                onComplete: done
            });
        },
        zoomEnter(el, done) {
            var tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                autoAlpha: 0,
                scale: 2,
                transformOrigin: '50% 50%'
            });

            tl.to(el, 1, {
                autoAlpha: 1,
                scale: 1,
                ease: Power4.easeOut
            });
        },
        zoomLeave(el, done) {
            TweenMax.to(el, 1, {
                scale: 0,
                ease: Power4.easeOut,
                onComplete: done
            });
        },
        flipXEnter(el, done) {
            var tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                autoAlpha: 0,
                rotationX: 90,
                transformOrigin: '50% 50%'
            });

            tl.to(el, 1, {
                autoAlpha: 1,
                rotationX: 0,
                ease: Power4.easeOut
            });
        },
        flipXLeave(el, done) {
            TweenMax.to(el, 1, {
                scale: 0,
                ease: Power4.easeOut,
                onComplete: done
            });
        },
        flipYEnter(el, done) {
            var tl = new TimelineMax({
                onComplete: done
            });

            tl.set(el, {
                autoAlpha: 0,
                rotationY: 90,
                transformOrigin: '50% 50%'
            });

            tl.to(el, 1, {
                autoAlpha: 1,
                rotationY: 0,
                ease: Power4.easeOut
            });
        },
        flipYLeave(el, done) {
            TweenMax.to(el, 1, {
                scale: 0,
                ease: Power4.easeOut,
                onComplete: done
            });
        },

        //Form Utils
        notifyError(error,excuse){
            if (error.response){
                this.$notify.error({
                        title: 'AN ERROR OCCURED',
                        message: error.response.data.message,
                        duration: 0
                });
            }else {
                this.$notify.error({
                        title: 'AN ERROR OCCURED',
                        message: excuse,
                        duration: 0
                });
            }
        },
        startLoading(target){
            this.$loading({
                    target,
                    lock: true,
                    text: "Please Wait...",
                    customClass: "preLoader"
            });
        },
        stopLoading(){
            $('.preLoader').remove();
        },
        validateForm(target){
            return new Promise((resolve,reject) =>{
                target.validate((valid) => {
                    if (valid) resolve(); else reject();
                })
            })
        },
    }
});