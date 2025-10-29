<!-- Language Toggle Component -->
<div class="lang-toggle">
    <form id="langForm" action="{{ route('change.translate') }}" method="GET">
        <label class="toggle">
            <input type="checkbox" name="lang" class="toggle-class" {{ session()->get('lo') ? 'checked' : '' }}>
            <span class="slider" data-on="Eng" data-off="اردو"></span>
        </label>
    </form>
</div>

{{-- CSS --}}
<style>
@font-face {
  font-family: 'Jameel Noori Nastaleeq';
  src: url('/fonts/Jameel Noori Nastaleeq Regular.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}


  /* Language Toggle Button Style */
.lang-toggle {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    font-family: 'Poppins';
    transition: 0.3s;
}

.language-toggle:hover {
    background-color: rgba(255, 255, 255, 1);
}

/* Toggle Switch Styling */
/* Compact Toggle with Inside Labels (Fixed Urdu Overlap) */
.toggle {
  position: relative;
  display: inline-block;
  width: 60px;     /* small but wide enough for both texts */
  height: 26px;
}

.toggle input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.3s;
  border-radius: 26px;
}

/* Text inside toggle */
.slider::after {
  content: attr(data-off);   /* Urdu by default */
  color: white;
  font-size: 12px;
  position: absolute;
  top: 50%;
  left: 28px; /* shifted right to prevent overlap */
  transform: translateY(-50%);
  font-family: 'Poppins', sans-serif;
}

/* White knob */
.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.3s;
  border-radius: 50%;
}

/* When checked (English active) */
.toggle input:checked + .slider {
  background-color: #1e8057;
}

/* Move knob when checked */
.toggle input:checked + .slider:before {
  transform: translateX(34px);
}

/* Change label to English and position left */
.toggle input:checked + .slider::after {
  content: attr(data-on);
  left: 8px; /* slightly left so Eng stays visible */
}

/* Hide external labels */
.labels {
  display: none;
}


.labels::before {
  content: attr(data-off);
}

.toggle input:checked ~ .labels::before {
  content: attr(data-on);
}
</style>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.toggle-class');
    if (toggle) {
        toggle.addEventListener('change', function() {
            const form = document.getElementById('langForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'lang';
            input.value = this.checked ? '1' : '0';
            form.appendChild(input);
            form.submit();
        });
    }
});
</script>
