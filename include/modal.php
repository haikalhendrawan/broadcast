    <!--Preview File Modal-->
    <div class="modal fade bd-example-modal-lg" id="filemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview File Panduan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                 </div>
                
                 <div class="modal-body">
                    <embed src="Uploads/<?php fetchfile()?>" frameborder="0" width="100%" height="1000px">
                 </div>
            </div>
        </div>
    </div>

    <!--Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Keluar dari aplikasi?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Broadcast Completed Modal -->
    <div class="modal fade" id="completemodal2" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLongTitle">Complete Broadcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-900">
                Anda sudah menyelesaikan broadcast ini? 
                </div>
                <div class="modal-footer">
                    <form method="POST" action="updatebroadcaststatus.php">
                    <input type="hidden" name="modalbroadcastid" id="broadcastid" value="">
                    <button type="submit" class="btn btn-primary" name="donebroadcast">Ya</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Belum</button>
                </div>
            </div>
        </div>
    </div>

    <!--  Submit Broadcast Modal -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLongTitle">Submit Broadcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-900">
                Pastikan kembali data yang di input sudah benar. <br>
                Lanjut submit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

        <!--  Submit Feedback Modal -->
        <div class="modal fade" id="submitfeedbackmodal" name="submitfeedbackmodal" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="submitfeedbacktitle">Submit Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-900">
                Pastikan kembali data yang di input sudah benar. <br>
                Lanjut submit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

        <!--  Mark as Complete Modal -->
        <div class="modal fade" id="completemodal" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLongTitle">Complete Broadcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-900">
                Anda sudah menyelesaikan broadcast ini? 
                </div>
                <div class="modal-footer">
                    <form action="readbroadcast.php" method="get">
                    <input type="submit" class="btn btn-success" name="yes" value="Ya"></button> 
                    </form>  
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>