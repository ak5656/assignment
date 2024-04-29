<template>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="container">
      <div
        class="alert alert-success"
        role="alert"
        v-show="jobSaveStatus"
      >
        <strong>Jobs</strong> added!
      </div>

      <div
        class="alert alert-danger"
        role="alert"
        v-show="validationMsg"
      >
        <strong>Validation</strong> failed (All fields are required)
      </div>
      
      <form @submit.prevent="createJob">
        <div class="mb-3 row">
          <input type="hidden" value="{{ csrf_token() }}">
          <label
            for="inputName"
            class="col-4 col-form-label"
            >Name</label
          >
          <div
            class="col-8"
          >
            <input
              type="text"
              class="form-control"
              v-model="joburl"
              id="inputName"
              placeholder="Enter URL eg. /my-path/domyjob"
            />
          </div>
        </div>
        <fieldset class="mb-3 row">
          <legend
            class="col-form-legend col-4"
          >
            Create Job
          </legend>
          <div
            class="col-8"
          >
            <div class="mb-3">
              <label for="" class="form-label">City</label>
              <select
                class="form-select form-select-lg"
                v-model="frequency"
                id=""
              >
                <option selected value="">Select one</option>
                <option value="everyMinute">everyMinute</option>
                <option value="everyTwoMinutes">everyTwoMinutes</option>
                <option value="everyTenSeconds">everyTenSeconds</option>
                <option value="everyTwentySeconds">everyTwentySeconds</option>
              </select>
            </div>
            
          </div>
        </fieldset>
        <div class="mb-3 row">
          <div class="offset-sm-4 col-sm-8">
            <button type="submit" class="btn btn-primary">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
    
  </div>
</main>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      joburl: '',
      frequency: '',
      jobSaveStatus: false,
      validationMsg: false,
    }
  },
  methods: {
    async createJob () {
      try {
        if (this.joburl === '' || this.frequency === '') {
          this.validationMsg = true;
          return false;
        }
        const { data } = await axios.post(
          '/jobtask2',
          {joburl: this.joburl, frequency: this.frequency},
          
        );
        console.log(data);
        this.jobSaveStatus = data.status;
        this.validationMsg = false;
        if (data.status) {
          setTimeout(() => {
            this.$router.push({path: '/dashboard'});
          }, 1000);
        }
          
      } catch (error) {
        // Handle the error
        console.error('An error occurred:', error);
      }
    }
  }
}

</script>
