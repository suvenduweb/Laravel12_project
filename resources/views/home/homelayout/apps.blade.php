  @php
    $apps = App\Models\App::find(1);
  @endphp

  <section class="lonyo-cta-section bg-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="lonyo-cta-thumb" data-aos="fade-up" data-aos-duration="500">
            <img id="appImage" src="{{asset($apps->image)}}" alt="" style="cursor: pointer; width:100%; max-width:300px">
            @if (auth()->check())
                <input type="file" id="uploadImage" style="display: none">
            @endif
          </div>
        </div>
        <div class="col-lg-6">
          <div class="lonyo-default-content lonyo-cta-wrap" data-aos="fade-up" data-aos-duration="700">
            <h2 id="editable-title" class="editable-title" contenteditable="{{ auth()->check() ? 'true': 'false'}}" data-id="{{$apps->id}}">{{$apps->title}}</h2>
            <p id="editable-description" class="editable-description" contenteditable="{{ auth()->check() ? 'true': 'false'}}" data-id="{{$apps->id}}">{{$apps->description}}</p>
            <div class="lonyo-cta-info mt-50" data-aos="fade-up" data-aos-duration="900">
              <ul>
                <li>
                  <a href="https://www.apple.com/app-store/"><img src="{{asset('frontend/assets/images/v1/app-store.svg')}}" alt=""></a>
                </li>
                <li>
                  <a href="https://playstore.com/"><img src="{{asset('frontend/assets/images/v1/play-store.svg')}}" alt=""></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{--CSRF TOKEN--}}
  <meta name="csrf-token" content="{{csrf_token()}}">
<script>
document.addEventListener("DOMContentLoaded", function(){


    function saveChanges(element) {


        let appId = element.dataset.id;
        let field = element.classList.contains("editable-title") ? "title" : "description";
        let newValue = element.innerText.trim();

        fetch(`direct-update-app/${appId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ [field]: newValue })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(`${field} updated successfully`);
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Only intercept Enter on editable fields
    document.addEventListener("keydown", function (e) {
        const isEditable = e.target.getAttribute("contenteditable") === "true";

        if (isEditable && e.key === "Enter") {
            e.preventDefault();
            saveChanges(e.target);
        }
    });

    // Auto save on blur

    document.querySelectorAll(".editable-title, .editable-description").forEach(el => {
        el.addEventListener("blur", function(){
            saveChanges(el);
        });
    });

    /// Image Uploaded Function

    let imageElemet = document.getElementById("appImage");
    let uploadImage = document.getElementById("uploadImage");

    imageElemet.addEventListener("click", function() {
        @if (auth()->check())
            uploadInput.click();
        @endif
    });

    uploadInput.addEventListener("change", function () {
        let file = this.files[0];
        if(!file) return;

        let formData = new FormData();
        formData.append("image",file);
        formData.append("_token",document.querySelector('meta[name="csrf-token"]').getAttribute("content"));

        fetch(`direct-update-app/1`, {
            method: "POST",

            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                imageElement.src = data.image_url;
                console.log(`image updated successfully`);
            }
        })
        .catch(error => console.error("Error:", error));
    })
});

</script>
