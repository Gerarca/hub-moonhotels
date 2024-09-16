<template>
  <div class="container mt-5">
    <h1 class="text-center">Búsqueda</h1>
    <form @submit.prevent="performSearch">
      <div class="row g-3 d-flex justify-content-between">
          <div class="col-md-2">
            <label for="hotelId" class="form-label">Hotel</label>
            <select
              id="roomType"
              v-model="query.hotelId"
              class="form-select"
              aria-label="Selecciona el tipo de habitación"
            >
              <option value="1"> HotelLegs </option>
              <option value="2"> TravelDoorX </option>
              <option value="3"> Speedia </option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="checkIn" class="form-label">Entrada</label>
            <input
                type="date"
                id="checkIn"
                v-model="query.checkIn"
                class="form-control"
                aria-label="Check-in"
                required
            />
          </div>

          <div class="col-md-2">
            <label for="checkOut" class="form-label">Salida</label>
            <input
                type="date"
                id="checkOut"
                v-model="query.checkOut"
                class="form-control"
                aria-label="Check-out"
                required
            />
          </div>

          <div class="col-md-1">
            <label for="numberOfGuests" class="form-label">Huéspedes</label>
            <input
                type="number"
                id="numberOfGuests"
                v-model="query.numberOfGuests"
                class="form-control"
                placeholder="Número de Huéspedes"
                aria-label="Número de Huéspedes"
            />
          </div>

          <div class="col-md-1">
            <label for="numberOfRooms" class="form-label">Habitaciones</label>
            <input
                type="number"
                id="numberOfRooms"
                v-model="query.numberOfRooms"
                class="form-control"
                placeholder="Número de Habitaciones"
                aria-label="Número de Habitaciones"
            />
          </div>

          <div class="col-md-4 text-center d-flex align-items-center">
            <button class="btn btn-primary" type="submit">Buscar</button>
          </div>
      </div>
    </form>

    <!-- Result -->
    <div v-if="results.length > 0" class="row my-4">
      <div v-for="room in results" :key="room.roomId" class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Habitación {{ room.roomId }}</h5>
            <div v-for="rate in room.rates" :key="rate.mealPlanId">
              <p>
                <strong>Plan de comidas:</strong> {{ rate.mealPlanId }} <br />
                <strong>Precio:</strong> {{ rate.price }} EUR <br />
                <strong>Cancelable:</strong>
                <span v-if="rate.isCancellable">
                  <i class="bi bi-check-circle-fill text-success"></i> Sí
                </span>
                <span v-else>
                  <i class="bi bi-x-circle-fill text-danger"></i> No
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Message Not Match -->
    <div v-else-if="query && results.length === 0">
    <p class="text-center my-4">No se encontraron resultados.</p>
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    data() {
      return {
        query: {
          hotelId: "1",
          checkIn: "",
          checkOut: "",
          numberOfGuests: 1,
          numberOfRooms: 1,
          currency: "EUR",
        },
        results: [],
      };
    },
    methods: {
      async performSearch() {
        try {
          const response = await axios.post("/api/search", this.query);
          this.results = response.data.rooms;
        } catch (error) {
          console.error("Error al realizar la búsqueda", error);
        }
      },
    },
  };
</script>
