<template>
  <form class="flex flex-col space-y-2" @submit.prevent="submitForm" id="formular">
    <div class="hidden rounded-md p-3 bg-green-300" id="successmessage">
      Vielen Dank für deine Bestellung. Du erhältst eine Bestätigung per E-Mail
      zusammen mit der Rechnung.
    </div>
    <h4 class="pt-2">Deine Daten</h4>
    <TextInput
      v-model="form.pfadiname"
      label="Pfadiname"
      :required="false"
    />
    <BreakpointSpaceManager>
      <TextInput v-model="form.first_name" label="Vorname" />
      <TextInput v-model="form.last_name" label="Nachname" />
    </BreakpointSpaceManager>

    <TextInput v-model="form.email" label="E-Mail" />
    <h4 class="pt-2">Bestellung</h4>
    <SelectInput
      v-model="form.quantity"
      label="Ich hätte gerne ..."
      :options="options"
      :required="true"
    />

    <h4 class="pt-2">Lieferadresse</h4>
    <BreakpointSpaceManager>
      <TextInput
        v-model="form.delivery_first_name"
        label="Vorname (Lieferung)"
      />
      <TextInput
        v-model="form.delivery_last_name"
        label="Nachname (Lieferung)"
      />
    </BreakpointSpaceManager>
    <TextInput v-model="form.delivery_street" label="Strasse (Lieferung)" />
    <BreakpointSpaceManager>
      <TextInput v-model="form.delivery_zip" label="PLZ (Lieferung)" />
      <TextInput v-model="form.delivery_town" label="Ort (Lieferung)" />
    </BreakpointSpaceManager>
    <button
      type="submit"
      class="bg-book-red hover:bg-chapter-red text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
    >
      Bestellen
    </button>
  </form>
</template>

<script>
import TextInput from "./TextInput.vue";
import SelectInput from "./SelectInput.vue";
import BreakpointSpaceManager from "./BreakpointSpaceManager.vue";
export default {
  components: {
    TextInput,
    SelectInput,
    BreakpointSpaceManager,
  },
  data() {
    return {
      success: false,
      form: {
        first_name: undefined,
        last_name: undefined,
        pfadiname: undefined,
        email: undefined,
        delivery_first_name: undefined,
        delivery_last_name: undefined,
        delivery_street: undefined,
        delivery_zip: undefined,
        delivery_town: undefined,
        quantity: 20,
      },
      options: [
        {
          label: "Sammelbestellung von 20 Stück à CHF 22: Total CHF 440",
          value: 20,
        },
        {
          label: "Sammelbestellung von 50 Stück à CHF 20: Total CHF 1000",
          value: 50,
        },
        {
          label: "Sammelbestellung von 100 Stück à CHF 18: Total CHF 1800",
          value: 100,
        },
      ],
    };
  },
  methods: {
    async submitForm() {
      const backendURL = import.meta.env.VITE_BACKEND_URL;
      try {
        const response = await fetch(`${backendURL}/order`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify(this.form),
        });
        if (!response.ok) {
          throw new Error("Ein Fehler ist aufgetreten");
        }

        const responseData = await response.json();

        console.log("Success:", responseData);
        this.form = {};
        this.form.quantity = 20;
        this.success = true;
        const successElement = document.getElementById("successmessage");
        successElement.classList.remove("hidden");
        successElement.scrollIntoView({ behavior: "smooth" });

        return responseData;
      } catch (error) {
        // Handle any errors that occurred during the request
        console.error("Error:", error);
        throw error; // Rethrow the error if needed
      }
    },
  },
};
</script>
