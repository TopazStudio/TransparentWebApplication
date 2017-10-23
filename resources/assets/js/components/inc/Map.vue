<template>
    <div style="position: relative;">
        <p>Just to get a clear view of where you are.</p>
        <div id="locQuery">
            <gmap-autocomplete
                    v-model="address"
                    placeholder="Enter the location here"
                    :selectFirstOnEnter="true"
                    @place_changed="handlePlaceChange">
            </gmap-autocomplete>
        </div>
        <gmap-map
                id="map"
                ref="map"
                :center="center"
                :zoom="zoom"
                map-type-id="roadmap"
                @click="handleClick">
            <gmap-marker
                    :position="markerPosition"
                    :clickable="true"
                    :draggable="true"
            ></gmap-marker>
        </gmap-map>
    </div>
</template>
<script>
    import Vue from 'vue';
    import * as VueGoogleMaps from 'vue2-google-maps';

    const API_KEY = 'AIzaSyBixSBMVXJ-a_8a7VNzXttqmCIm7GP1WbU';

    Vue.use(VueGoogleMaps, {
        installComponents: true,
        load: {
            key: API_KEY,
            libraries: 'places',
        }
    });

    export default {
        data(){
            return{
                center: {lat: 0, lng: 0},
                zoom: 7,
                address: '',
                currentLatitude: '',
                currentLongitude: '',
                markerPosition: {lat: 0, lng: 0},
            }
        },
        async created(){
            await VueGoogleMaps.loaded;
            this.geolocate()
                .then(({data:{location:{lat,lng}}})=>{
                    this.center = this.markerPosition = {lat,lng};
                });
        },
        methods:{
            setLocation(LatLng,pan){
                this.markerPosition = LatLng;
                this.currentLatitude = LatLng.lat;
                this.currentLongitude = LatLng.lng;

                if(pan){
                    this.$refs.map.panTo(LatLng);
                    this.zoom = 10;
                }
            },
            geolocate(props){
                return new Promise(function(res,rej){
                    //First try by browser
                    if(navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(
                            function(position){
                                res(position.coords);
                            },function(error){
                                axios.post(`https://www.googleapis.com/geolocation/v1/geolocate?key=${API_KEY}`)
                                    .then(function(response){
                                        res(response);
                                    })
                                    .catch(function(error){
                                        console.log(error);
                                    });
                            });
                    }
                });
            },
            handleClick({latLng:{lat,lng}}){
                this.setLocation({lat:lat(),lng:lng()},true);
            },
            handlePlaceChange({geometry:{location:{lat,lng}}}){
                this.setLocation({lat:lat(),lng:lng()},true);
            },

        }
    }
</script>
<style lang="scss">
    #map{
        height: 400px;
        width: 100%;
        cursor: pointer;
    }
    #locQuery{
        position: absolute;
        left: 200px;
        background-color: white;
        border-radius: 4px;
        padding: 10px;
        z-index: 1000;
        input{
            width: 400px;
            height: 36px;
            padding: 3px 10px;
            border: 1px solid darkgrey;
            line-height: 1;
        }
    }
</style>