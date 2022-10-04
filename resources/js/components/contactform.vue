<template lang="">

    <div class="h-screen flex flex-col 
                    items-center justify-center">
            <p class="text-green-700 text-xl mb-3">
              Contact
            </p>
            
            <div v-if="errors">
              <div v-for="v,k in errors" :key="k" class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
                <p v-for="error in v" :key="error" class="text-sm">{{error}}</p>
              </div>

            </div>

            <div v-if="success">
              <div class="bg-green-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
                <p class="text-sm">Successfully Created</p>
              </div>

            </div>
           
            <form @submit.prevent="submit">
                <input v-model="name" aria-label="Enter your name" 
                       type="text" placeholder="Enter your name" 
                       class="text-sm text-gray-base w-full 
                              mr-3 py-5 px-4 h-2 border 
                              border-gray-200 rounded mb-2" />
                <input  v-model="email" aria-label="Enter your email" 
                       type="email" placeholder="Enter your email"
                       class="text-sm text-gray-base w-full mr-3 
                              py-5 px-4 h-2 border border-gray-200 
                              rounded mb-2" />
                <input v-model="phone" pattern=".{10,10}" aria-label="Enter your phone number" type="tel" placeholder="Enter your Phone Number" class="text-sm text-gray-base w-full mr-3 py-5 px-4 h-2 border border-gray-200 rounded mb-2"  maxlength="10"  title="Ten digits code" required/>
                <textarea v-model="message" id="textarea" placeholder="Enter your Message" class="text-sm text-gray-base w-full  h-40 border border-gray-200 
                rounded mb-2 resize-none" name="message" ></textarea>
                <button type="submit" class="bg-blue-400 w-full mt-4">Submit</button>
            </form>
        </div>
</template>
<script>
    
export default {
    name:'contactform',
    data () {
      return{
      name: null,
      email: null,
      phone: null,
      message: null,
      errors: null,
      success: false
      }
    },
    methods:{
    submit() {


      this.success = false;
      this.errors = null;
      
      var data = new FormData();
      data.append('name', this.name);
      data.append('email', this.email);
      data.append('phone', this.phone);
      data.append('message', this.message);

      var inputvalue =this;
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '/api/contact', true);
      xhr.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE){
          if(this.status===200){
        
           
            inputvalue.success = true;
            inputvalue.name = null;
            inputvalue.email = null;
            inputvalue.phone = null;
            inputvalue.message = null;
          }else if(this.status===401){
            var result = JSON.parse(this.responseText);
            inputvalue.errors = result;
          }
        }
        
          
      };
      xhr.send(data);
      
    }
  }
   
  
}
</script>
<style lang="">

</style>