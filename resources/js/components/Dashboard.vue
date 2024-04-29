<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Schedule Jobs</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
          <svg class="bi"><use xlink:href="#calendar3"/></svg>
          This week
        </button>
      </div>
    </div>
    <div
      class="alert alert-success"
      role="alert"
      v-show="jobRemoveStatus"
    >
      <strong>Jobs</strong> Deleted!
    </div>
    <h2>Jobs</h2>
    <div class="table-responsive small">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Url (job task)</th>
            <th scope="col">Frequency</th>
            <th scope="col">User</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in allJobtask" :key="task.id">
            <td>{{ task.joburl }}</td>
            <td>{{ task.frequency }}</td>
            <td>{{ task.user.name }}</td>
            <td>
              <div>
                <span style="cursor: pointer; display:inline-flex;">
                        <router-link to='/createjobs' class="nav-link d-flex align-items-center gap-2 active">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                          </svg>
                        </router-link>          
                </span>
                <span style="padding-left: 10px; cursor: pointer; display: inline-flex;" @click="setJobtaskId(task.id)">
                  <svg                    
                    :dt="task.id"
                    data-bs-toggle="modal" 
                    data-bs-target="#modalId" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                      <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg>  
                </span>
              </div>  
            </td>
          </tr>   
        </tbody>
      </table>
      <div
        class="alert alert-primary"
        role="alert"
        style="text-align: center;"
        v-show="noRecord"
      >
        <strong>No Record</strong> Currently No record found.
      </div>  
      <!-- Modal trigger button -->
      <!-- <button
        type="button"
        class="btn btn-primary btn-lg"
        data-bs-toggle="modal"
        data-bs-target="#modalId"
      >
        Launch
      </button> -->
      
      <!-- Modal Body -->
      <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
      <div
        class="modal fade"
        id="modalId"
        tabindex="-1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
      >
        <div
          class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">
                Delete
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">Sure to delete the schedule job?</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="button" class="btn btn-primary" @click="deleteJob()">Save</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Optional: Place to the bottom of scripts -->
      
      

    </div>
  </main>
</template>
<script>
import axios from 'axios';
// import { Modal } from 'bootstrap';
export default {
  data() {
    return {
      allJobtask: [],
      jobDeleteId: 0,
      modalShow: true,
      jobRemoveStatus: false,
      noRecord: false
    }
  },
  methods: {
    async getJobtask () {
      try {
        var res = axios.get('/jobtask2');
        res.then((dt) => {
            this.allJobtask = dt.data.data;
            if(this.allJobtask.length ===0)
              this.noRecord = true;
            console.log(this.allJobtask);
        });
      }
       catch (error) {
        console.log(error);
      }

    },
    setJobtaskId(taskId) {
      this.jobDeleteId = taskId;
    },
    deleteJob() {
      var res = axios.delete('/jobtask2/' + this.jobDeleteId,);
      res.then((rs) => {
        if (rs.data.status) {
          this.jobRemoveStatus = true;
          this.getJobtask();
        }
      });
        
    },
  },
  mounted() {
    this.getJobtask();
  },
}
</script>