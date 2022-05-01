<div class="notes-section">
    <div class="notes-title d-flex align-items-center justify-content-between pb-2 mb-3">
        <h3 class="mb-0">Note</h3>
        <a href="#" data-bs-toggle="modal" data-bs-target="#notesAddModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="15.397" height="15.397" viewBox="0 0 15.397 15.397">
                <path id="Icon_awesome-plus" data-name="Icon awesome-plus" d="M14.3,8.3H9.348V3.35a1.1,1.1,0,0,0-1.1-1.1h-1.1a1.1,1.1,0,0,0-1.1,1.1V8.3H1.1A1.1,1.1,0,0,0,0,9.4v1.1a1.1,1.1,0,0,0,1.1,1.1H6.049v4.949a1.1,1.1,0,0,0,1.1,1.1h1.1a1.1,1.1,0,0,0,1.1-1.1V11.6H14.3a1.1,1.1,0,0,0,1.1-1.1V9.4A1.1,1.1,0,0,0,14.3,8.3Z" transform="translate(0 -2.25)" fill="#000944"></path>
            </svg>
        </a>
    </div>
    <div class="accordion notes-accordion" id="accordionExample">
        <div class="accordion-item" v-for="note in userNoteList" :key="note.id">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button flex-wrap collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    @{{note.title}}
                    <div class="notes-date w-100">@{{note.created_time}}</div>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <p>
                        @{{note.description}}
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="notes-date">@{{note.created_time}}</div>
                        <a href="javascript:void(0);" @click="deleteNote(note)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18.679" height="17.944" viewBox="0 0 18.679 17.944">
                                <g id="Icon_feather-trash-2" data-name="Icon feather-trash-2" transform="translate(1 1)">
                                    <path id="Path_16077" data-name="Path 16077" d="M4.5,9H21.179" transform="translate(-4.5 -4.447)" fill="none" stroke="#ffa0a0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path id="Path_16078" data-name="Path 16078" d="M18.179,6.189V17.35a1.561,1.561,0,0,1-1.526,1.594H9.026A1.561,1.561,0,0,1,7.5,17.35V6.189m2.288,0V4.594A1.561,1.561,0,0,1,11.314,3h3.051A1.561,1.561,0,0,1,15.89,4.594V6.189" transform="translate(-4.5 -3)" fill="none" stroke="#ffa0a0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path id="Path_16079" data-name="Path 16079" d="M15,16.5v9" transform="translate(-8.514 -12.036)" fill="none" stroke="#ffa0a0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path id="Path_16080" data-name="Path 16080" d="M21,16.5v9" transform="translate(-10.807 -12.036)" fill="none" stroke="#ffa0a0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
