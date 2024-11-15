import {
  StyleSheet,
  Text,
  View,
  Image,
  ScrollView,
  TouchableOpacity,
  Modal,
} from "react-native";
import axios from "axios";
import React, { useState, useContext, useEffect } from "react";
import WhitebackButton from "../svg/SvgIcon/WhiteBackButoon";
import FilterIcon from "../svg/SvgIcon/Filter";
import LocationColor from "../svg/SvgIcon/LocationColor";
import Auto from "../svg/SvgIcon/Auto";
import { BlurView } from "expo-blur";
import themeContext from "../theme/themeContext";
import RequesttoJoin from "../Components/RequesttoJoin";
import Backbuttonicon from "../svg/SvgIcon/BackButton";
import theme from "../theme/theme";
import FinalAuto from "../svg/SvgIcon/FinalAuto";
import FilterRider from "../Components/FilterRider";
import Taxi from "../svg/SvgIcon/Taxi";
import ColorAuto from "../svg/SvgIcon/ColorAuto";
import { useNavigation, useRoute } from "@react-navigation/native";
import { API } from "../../Shared/Utile";

import AsyncStorage from "@react-native-async-storage/async-storage";

const RiderListFinal = (navigation) => {
  const route = useRoute();
  const from = route.params?.from;
  const to = route.params?.to;

  const navigate = useNavigation();

  const Riders = [
    { name: "Rohith Krishna", Distance: 200 },
    { name: "Snaha Babu G", Distance: 201 },
    { name: "Adithyan s sunil", Distance: 300 },
  ];
  const filteredRider = [...Riders, ...Array(5 - Riders.length).fill(null)];
  const theme = useContext(themeContext);
  const [modalVisible, setModalVisible] = useState(false);
  const [filtermodel, setFilterModel] = useState(false);
  const [group, setGroup] = useState([]);
  const toggleModal = () => {
    setModalVisible(!modalVisible);
  };
  const tooglefiltermodel = () => {
    setFilterModel(!filtermodel);
  };

  React.useEffect(() => {
    axios.get(API + "riderGroup/allrideGroups").then((response) => {
      // console.log(response.data, "data fetched ");
      setGroup(response.data);
    });
  }, []);


  useEffect(() => {
    const fetchData = async () => {
      try {
        const data = await AsyncStorage.getItem("user");
        console.log(data, "user data ");
      } catch (error) {
        // console.error("Failed to fetch data from AsyncStorage:", error);
      }
    };
    fetchData();
  }, []);

  return (
    <View style={styles.container}>
      <View
        style={[
          styles.secondcontainer,
          { backgroundColor: theme.theme === "dark" ? "#262626" : "#FFFFFF" },
        ]}
      >
        {/* Header part */}
        <View style={styles.header}>
          <View style={styles.headerobjects}>
            {theme.theme === "dark" ? <WhitebackButton /> : <Backbuttonicon />}
          </View>
          <View style={styles.headerobjectsmain}>
            <Text
              style={[
                styles.headerText,
                { color: theme.theme === "dark" ? "white" : "#151419" },
              ]}
            >
              Riders
            </Text>
          </View>
          <View style={styles.headerobject}>
            <TouchableOpacity onPress={tooglefiltermodel}>
              <FilterIcon />
            </TouchableOpacity>
          </View>
        </View>

        {/* ScrollView for the rider list */}
        <View
          style={{
            width: "100%",
            height: "73%",
          }}
        >
          <ScrollView
            style={styles.scrollView}
            contentContainerStyle={styles.scrollContent}
          >
            {/* <View>
              <TouchableOpacity onPress={toggleModal}>
                <View
                  style={[
                    styles.firstGroup,
                    {
                      backgroundColor:
                        theme.theme === "dark" ? "#87878733" : "white",
                    },
                  ]}
                >
                  <View style={styles.box1}>
                    <View
                      style={[
                        styles.circlebox,
                        {
                          backgroundColor:
                            theme.theme === "dark" ? "black" : "white",
                        },
                      ]}
                    >
                      <Taxi style={styles.taxiIcon} />
                    </View>
                  </View>
                  <View style={styles.box2}>
                    <Text
                      style={[
                        styles.riderName,
                        {
                          color: theme.theme === "dark" ? "white" : "#151419",
                        },
                      ]}
                    >
                      Aftab, Amal...
                    </Text>
                    <View style={styles.count}>
                      <Text style={styles.countText}>2+</Text>
                    </View>
                  </View>
                  <View style={styles.box3}>
                    <LocationColor />
                    <Text
                      style={[
                        styles.distanceText,
                        {
                          color: theme.theme === "dark" ? "white" : "#151419",
                        },
                      ]}
                    >
                      250m
                    </Text>
                  </View>
                </View>
              </TouchableOpacity>
            </View> */}

            <View>
              {group.map((ride, index) => (
                <TouchableOpacity key={ride.id} onPress={toggleModal}>
                  <View
                    style={[
                      styles.firstGroup,
                      {
                        backgroundColor:
                          theme.theme === "dark" ? "#87878733" : "white",
                      },
                    ]}
                  >
                    <View style={styles.box1}>
                      <View
                        style={[
                          styles.circlebox,
                          {
                            backgroundColor:
                              theme.theme === "dark" ? "black" : "white",
                          },
                        ]}
                      >
                        {ride.riderType == "car" ? (
                          <Taxi style={styles.taxiIcon} />
                        ) : (
                          <FinalAuto />
                        )}
                      </View>
                    </View>
                    <View style={styles.box2}>
                      <Text
                        style={[
                          styles.riderName,
                          {
                            color: theme.theme === "dark" ? "white" : "#151419",
                          },
                        ]}
                      >
                        {ride.riderType}
                      </Text>
                      <View style={styles.count}>
                        <Text style={styles.countText}>
                          {ride.passengerLimit}+
                        </Text>
                      </View>
                    </View>
                    <View style={styles.box3}>
                      <LocationColor />
                      <Text
                        style={[
                          styles.distanceText,
                          {
                            color: theme.theme === "dark" ? "white" : "#151419",
                          },
                        ]}
                      >
                        {/* Replace 250m with a dynamically calculated distance if needed */}
                        250m
                      </Text>
                    </View>
                  </View>
                </TouchableOpacity>
              ))}
            </View>

            {/* Second rider item */}
            {filteredRider.map((rider, index) => {
              return (
                <View
                  style={[
                    styles.iteration,
                    {
                      backgroundColor:
                        theme.theme === "dark" ? "#87878733" : "white",
                    },
                  ]}
                  key={index}
                >
                  <View style={styles.box1}>
                    <View style={styles.circlewhithoutback}>
                      {rider ? <FinalAuto /> : null}
                    </View>
                  </View>
                  <View style={styles.box2}>
                    {rider ? (
                      <Text
                        style={[
                          styles.riderName,
                          {
                            color: theme.theme === "dark" ? "white" : "#151419",
                          },
                        ]}
                      >
                        {rider.name}
                      </Text>
                    ) : (
                      <Text style={styles.riderName}></Text>
                    )}
                  </View>
                  <View style={styles.box3}>
                    {rider ? (
                      <>
                        <LocationColor />
                        <Text
                          style={[
                            styles.distanceText,
                            {
                              color:
                                theme.theme === "dark" ? "white" : "#151419",
                            },
                          ]}
                        >
                          {rider.Distance}m
                        </Text>
                      </>
                    ) : null}
                  </View>
                </View>
              );
            })}
          </ScrollView>
        </View>
        {/* button goes here */}
        <View
          style={{
            width: "100%",
            height: "22%",
            paddingHorizontal: 10,
            paddingVertical: 4,
          }}
        >
          <TouchableOpacity
            onPress={() =>
              navigate.navigate("createNewRide", { from: from, to: to })
            }
          >
            <View style={styles.iterations}>
              <Text
                style={{
                  fontSize: 16,
                  fontWeight: 600,
                  color: "white",
                  fontFamily: "GabaritoVariableFontwght",
                }}
              >
                Create New
              </Text>
            </View>
          </TouchableOpacity>
          <View style={styles.texts}>
            <Text
              style={{
                fontSize: 12,
                fontFamily: "GabaritoVariableFontwght",
                color: "#878787",
              }}
            >
              Meet new people by starting a group and
            </Text>
            <Text
              style={{
                fontSize: 12,
                fontFamily: "GabaritoVariableFontwght",
                color: "#878787",
              }}
            >
              bringing others together!
            </Text>
          </View>
        </View>
      </View>
      {modalVisible && (
        <BlurView
          intensity={50}
          style={StyleSheet.absoluteFill}
          reducedTransparencyFallbackColor=""
        >
          <Modal
            visible={modalVisible}
            transparent={true}
            animationType="fade"
            onRequestClose={toggleModal} // Close modal on back button
          >
            <View
              style={[
                styles.modalOverlay,
                {
                  backgroundColor:
                    theme.theme === "dark"
                      ? "rgba(0, 0, 0, 0.6)"
                      : "rgba(255, 255, 255, 0.9)",
                },
              ]}
            >
              <View style={styles.modalContent}>
                <RequesttoJoin closemodel={toggleModal} />
              </View>
            </View>
          </Modal>
        </BlurView>
      )}

      {filtermodel && (
        <BlurView
          intensity={50}
          style={StyleSheet.absoluteFill}
          blurAmount={3}
          blurRadius={5}
        >
          <Modal
            visible={filtermodel}
            transparent={true}
            animationType="fade"
            onRequestClose={tooglefiltermodel} // Close modal on back button
          >
            <View
              style={[
                styles.modalOverlay,
                {
                  backgroundColor:
                    theme.theme === "dark"
                      ? "rgba(0, 0, 0, 0.6)"
                      : "rgba(255, 255, 255, 0.9)",
                },
              ]}
            >
              <View style={styles.modalContent}>
                <FilterRider closemodel={tooglefiltermodel} />
              </View>
            </View>
          </Modal>
        </BlurView>
      )}
    </View>
  );
};

export default RiderListFinal;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: "center",
  },
  secondcontainer: {
    width: "95%",
    height: "83%",
    borderRadius: 30,
    elevation: 5,
    paddingBottom: 10,
    marginTop: "10%",
  },
  header: {
    width: "100%",
    height: "8%",
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    marginBottom: 10,
  },
  headerobjects: {
    width: "29%",
    justifyContent: "center",
    paddingHorizontal: 20,
  },
  headerobjectsmain: {
    width: "30%",
    justifyContent: "center",
    alignItems: "center",
  },
  headerobject: {
    width: "30%",
    justifyContent: "center",
    alignItems: "center",
  },
  headerText: {
    fontSize: 20,
    fontWeight: "700",
    fontFamily: "GabaritoVariableFontwght",
  },
  scrollView: {
    width: "100%",
    height: "100%",
    paddingHorizontal: 10,
    paddingVertical: 10,
  },
  scrollContent: {
    paddingBottom: 20,
  },
  firstGroup: {
    width: "100%",
    height: 65,
    marginBottom: 10,
    borderRadius: 40,
    flexDirection: "row",
    alignItems: "center",
    paddingHorizontal: 10,
    elevation: 2,
  },
  iteration: {
    width: "100%",
    height: 65,
    marginBottom: 10,
    borderRadius: 40,
    flexDirection: "row",
    alignItems: "center",
    paddingHorizontal: 10,
    elevation: 2,
  },
  box1: {
    width: "20%",
    alignItems: "center",
    justifyContent: "center",
  },
  circlebox: {
    width: 45,
    height: 45,
    borderRadius: 30,
    alignItems: "center",
    justifyContent: "center",
  },
  box2: {
    width: "60%",
    flexDirection: "row",
    alignItems: "center",
  },
  riderName: {
    fontSize: 16,
    fontWeight: "700",
    fontFamily: "GabaritoVariableFontwght",
  },
  count: {
    marginLeft: 5,
    width: 30,
    height: 20,
    borderWidth: 1,
    borderRadius: 15,
    borderColor: "#F56E0F",
    alignItems: "center",
    justifyContent: "center",
  },
  countText: {
    fontSize: 12,
    fontWeight: "800",
    color: "#F56E0F",
  },
  box3: {
    width: "20%",
    flexDirection: "row",
    alignItems: "center",
  },
  distanceText: {
    marginLeft: 3,
    fontWeight: "700",
    fontSize: 12,
    fontFamily: "GabaritoVariableFontwght",
  },
  circlewhithoutback: {
    width: 40,
    height: 40,
    borderRadius: 20,
    alignItems: "center",
    justifyContent: "center",
  },
  iterations: {
    width: "100%",
    height: 60,
    backgroundColor: "#F56E0F",
    borderRadius: 40,
    justifyContent: "center",
    alignItems: "center",
  },
  texts: {
    width: "100%",
    height: "40%",
    alignItems: "center",
  },
  modalOverlay: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
  },
  modalContent: {
    width: 364,
    height: 300,
    borderRadius: 20,
    padding: 20,
  },
  taxiIcon: {
    top: 20,
    left: 9,
  },
});
