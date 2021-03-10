<template>
  <div class="bgimg">
    <div class="topleft">
    <p>Logo</p>
    </div>
    <div class="middle">
    <h1>Welcome</h1>
    
    <router-link class="button" to="user">Enter</router-link>
    </div>
    <div class="bottomleft">
    <p>Some text</p>
    </div>
  </div>
</template>

<script>

export default {
  name: 'home',
   components: {
     
  }
}

</script>

<style>
/* Set height to 100% for body and html to enable the background image to cover the whole page: */

.bgimg{
  /* Background image */
  background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
  /* Full-screen */
  height: 37rem;
   background-attachment: fixed;
  /* Center the background image */
  background-position: center;
  /* Scale and zoom in the image */
  background-size: cover;
  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
  position: relative;
  /* Add a white text color to all elements inside the .bgimg container */
  /* Add a font */
  font-family: "Courier New", Courier, monospace;
  /* Set the font-size to 25 pixels */
  font-size: 25px;
}

/* Position text in the top-left corner */
.topleft {
  position: absolute;
  top: 0;
  left: 16px;
  color: white;
}
.button{
  border: 2px solid white;
  background-color: transparent;
  color: white;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  margin-top: 20px;
  text-decoration: none;
}
.button:focus {
  outline: none;
  box-shadow: none;
  text-decoration: none;
  color: white;
  
}

/* Position text in the bottom-left corner */
.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
  color: white;
}

/* Position text in the middle */
.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
}

/* Style the <hr> element */
hr {
  margin: auto;
  width: 40%;
  color: white;
}
</style>
